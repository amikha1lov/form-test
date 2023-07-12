<?php

namespace App\Services;

use Laminas\Diactoros\Response\JsonResponse;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailService
{

    public static function sendEmail($address,$subject, $message)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['SMTP_USERNAME'];
            $mail->Password   = $_ENV['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $_ENV['SMTP_PORT'];
            $mail->setFrom($_ENV['SMTP_USERNAME']);
            $mail->addAddress($address);

            $mail->isHTML(true);
            $mail->Subject = $subject;

            $sendData = '';


            foreach ($message as $key => $value) {

                $sendData .= 'Поле ' . $key . ' : ' . $value.'<br>';

            }



            $mail->msgHTML($sendData);

            $mail->send();
        } catch (Exception $e) {
            return new JsonResponse([
                'error' => true,
                'message' => $mail->ErrorInfo
            ]);
        }
    }
}