<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpmailer/src/Exception.php';
require '../Assets/phpmailer/src/PHPMailer.php';
require '../Assets/phpmailer/src/SMTP.php';

function sendEmail($recipientEmail,$subject,$message) {
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hmshostel@gmail.com';
        $mail->Password = 'zhlljothtysockzf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('hmshostel@gmail.com', 'HMS Hostel');
        $mail->addAddress($recipientEmail);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        return $mail->send();
    } catch (Exception $e) {
        return false;
    }
}
?>
