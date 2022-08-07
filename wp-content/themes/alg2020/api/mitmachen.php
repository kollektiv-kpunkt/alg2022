<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];

if($json = json_decode(file_get_contents("php://input"), true)) {
    $data = $json;
} else {
    $data = $_POST;
}
global $mail;

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
    "message" => "Mail sent successfully",
    "code" => "s-1-41"
];
echo json_encode($return);
?>