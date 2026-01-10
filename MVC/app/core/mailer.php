<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public static function sendTestMail($toEmail)
    {
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/Exception.php';
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/SMTP.php';
        $mail = new PHPMailer(true);

        try {
            // SMTP config (example: Gmail)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'careersync1@gmail.com';
            $mail->Password   = 'kutbfksfllmtdxkr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Sender & recipient
            $mail->setFrom('your_email@gmail.com', 'CareerSync');
            $mail->addAddress($toEmail);


            $mail->isHTML(true);
            $mail->Subject = 'CareerSync Registration Successful';
            $mail->Body    = '<h3>Welcome to CareerSync</h3><p>Your registration was successful.</p>';
            $mail->AltBody = 'Welcome to CareerSync. Your registration was successful.';

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail Error: {$mail->ErrorInfo}");
            return false;
        }
    }

    public static function feedBackEmail($fromEmail, $fromName, $message)
    {
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/Exception.php';
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        try {
            // SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'careersync1@gmail.com';
            $mail->Password   = 'kutbfksfllmtdxkr';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('careersync1@gmail.com', 'CareerSync Feedback');

            $mail->addReplyTo($fromEmail, $fromName);

            $mail->addAddress('careersync1@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = 'New Feedback Message';
            $mail->Body = "
            <h3>New Feedback Received</h3>
            <p><strong>From:</strong> {$fromName} ({$fromEmail})</p>
            <p><strong>Message:</strong></p>
            <p>" . nl2br(htmlspecialchars($message)) . "</p>
        ";

            $mail->AltBody = "From: $fromName ($fromEmail)\n\n$message";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
