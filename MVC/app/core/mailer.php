<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{   
    private static function makeMailer(): PHPMailer
    {
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/Exception.php';
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/PHPMailer.php';
        require_once __DIR__ . '/../../../vendor/PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);

        // SMTP config (Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'careersync1@gmail.com';
        $mail->Password   = 'kutbfksfllmtdxkr'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        return $mail;
    }

    public static function sendTestMail($toEmail): bool
    {
        try {
            $mail = self::makeMailer();

            // Send FROM your own inbox (important for deliverability)
            $mail->setFrom('careersync1@gmail.com', 'CareerSync');
            $mail->addAddress($toEmail);

            $mail->Subject = 'CareerSync Registration Successful';
            $mail->Body    = '<h3>Welcome to CareerSync</h3><p>Your registration was successful.</p>';
            $mail->AltBody = 'Welcome to CareerSync. Your registration was successful.';

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail Error: " . $e->getMessage());
            return false;
        }
    }

    public static function feedBackEmail(string $fromEmail, string $fromName, string $message): bool
    {
        try {
            $mail = self::makeMailer();

            // Always send FROM your own inbox (avoid DMARC/SPF issues)
            $mail->setFrom('careersync1@gmail.com', 'CareerSync Feedback');

            // Put user in Reply-To so you can reply safely
            $mail->addReplyTo($fromEmail, $fromName);

            // Where the message goes
            $mail->addAddress('careersync1@gmail.com');

            $safeName  = htmlspecialchars($fromName, ENT_QUOTES, 'UTF-8');
            $safeEmail = htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8');
            $safeMsg   = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

            $mail->Subject = 'New Contact Message - CareerSync';
            $mail->Body = "
                <h3>New Contact Message</h3>
                <p><strong>From:</strong> {$safeName} ({$safeEmail})</p>
                <p><strong>Message:</strong></p>
                <p>{$safeMsg}</p>
            ";

            $mail->AltBody = "From: $fromName ($fromEmail)\n\n$message";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail Error: " . $e->getMessage());
            return false;
        }
    }
}