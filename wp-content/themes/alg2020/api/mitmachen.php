<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];


if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}
global $mail;

if (isset($data["token"])) {
    define("RECAPTCHA_V3_SECRET_KEY", '6LdLtVohAAAAAKsAkeilGyfDJi38JP0HUE2L_q6Z');
    $token = $data['token'];
    $action = $data['action'];

    // call curl to POST request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('secret' => RECAPTCHA_V3_SECRET_KEY, 'response' => $token)));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $arrResponse = json_decode($response, true);

    // verify the response
    if($arrResponse["success"] == '1' && $arrResponse["action"] == $action && $arrResponse["score"] >= 0.5) {
        $gRecaptcha = true;
    }

    if (!$gRecaptcha) {
        echo json_encode(array("status" => "error", "message" => "Captcha failed"));
        exit;
    }
}


$optin = $data["optin"] ? "<li>Opt-In: Ja</li>" : "<li>Opt-In: Nein</li>";

$emailcontent = <<<EOD
<div style="font-family: sans-serif">
    <p>Hallo!</p>
    <p>Eine neue Person hat sich auf {$actual_link} als Unterstützer*in eingetragen. Hier die Details:</p>
    <ul>
        <li>Name: {$data["name"]}</li>
        <li>E-Mail: {$data["email"]}</li>
        {$optin}
    </ul>
    <p>Viele Grüße,<br>
    <b>Timothy</b></p>
<div>
EOD;

$mail->clearAllRecipients( );
$mail->addAddress($_ENV["ADMINEMAIL"]);
$mail->isHTML(true);
$mail->Subject = "Neue*r Unterstützer*in: {$data["name"]}";
$mail->Body    = $emailcontent;

if (!$mail->send()){
    $return = [
        "status" => "error",
        "message" => "Mailer Error: " . $mail->ErrorInfo,
        "code" => "e-1-35"
    ];
    echo json_encode($return);
    exit;
}

$return = [
    "status" => "success",
    "message" => "Danke für deine Unterstützung!",
    "code" => "s-1-41",
];
echo json_encode($return);
?>