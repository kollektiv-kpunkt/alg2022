<?php
require '../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter as Router;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$mail = new PHPMailer(true);
global $mail;
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $_ENV["MAILSERVER"];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV["MAILUSER"];
    $mail->Password   = $_ENV["MAILPW"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = $_ENV["MAILPORT"];
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('de');
    $mail->setFrom($_ENV["MAILUSER"], 'Timothy Oesch');
} catch (Exception $e) {
    echo "Error setting up Email: {$mail->ErrorInfo}";
}

Router::post('/api/v1/mitmachen/', function() {
    include(__DIR__ . "/mitmachen.php");
    exit;
});

Router::start();