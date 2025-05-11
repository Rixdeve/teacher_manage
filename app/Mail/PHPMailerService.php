<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class PHPMailerService
{
    public function sendMail($user_email, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tlmslanka@gmail.com';
            $mail->Password = 'bsnmwzfeglfzlgmf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('tlmslanka@gmail.com', 'TLMS Lanka');
            $mail->addAddress($user_email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Send the email
            $mail->send();
            return 'Message has been sent';
        } catch (Exception $e) {
            Log::error('Mail sending failed: ' . $e->errorMessage());
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
