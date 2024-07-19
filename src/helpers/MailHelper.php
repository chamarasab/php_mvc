<?php

namespace Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

class MailHelper
{
    public static function sendResetEmail($email, $resetLink)
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';

            // Authentication
            $mail->Username = 'chamarapriyadarshana.dev@gmail.com';
            $mail->Password = 'yylwbrtfsekdpmgo';

            // Recipients
            $mail->setFrom('chamarapriyadarshana.dev@gmail.com', 'eBank HelpDesk');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Resetting Confirmation!';

            $mail->Body = "
                <p>Dear valued customer,</p>
                <p>Your password reset request has been received.</p>
                <p>Your reset token is: <strong>{$resetLink}</strong></p>
                <p>Please copy this token and paste it into the password reset form in the client application to reset your password.</p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <p>Thank you,</p>
                <p>eBank HelpDesk,<br>People's Bank</p>
            ";

            if ($mail->send()) {
                return true;
            } else {
                error_log('Mailer Error: ' . $mail->ErrorInfo);
                return false;
            }
        } catch (Exception $e) {
            error_log('Mailer Exception: ' . $e->getMessage());
            return false;
        }
    }
}
?>
