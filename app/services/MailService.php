<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\DAO\UserDAO;

class MailService
{
    static public function sendValidationEmail($email)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = MAIL_PORT;

            $mail->setFrom(MAIL_USERNAME, 'Sistema de Cadastro');
            $mail->addAddress($email);

            $token = self::ssl_crypt($email);
            $link = "http://localhost:4242/mail-validation/$token";
            $mail->isHTML(true);
            $mail->Subject = 'Valide seu email';
            $mail->Body = "Clique no link para ativar sua conta: <a href='$link'>$link</a>";

            $mail->send();
            return 'Email de validação enviado.';
        } catch (Exception $e) {
            error_log("Erro ao enviar email: " . $e->getMessage());
            throw new \Exception("Erro ao enviar o email: " . $e->getMessage());
        }
    }

    static public function validarEmail($token) {
        $email = self::ssl_decrypt($token);
        $userDAO = new UserDAO();
        
        $userDAO->validarEmail($email);
        $_SESSION['success_message'] = 'Email validado com sucesso!';
        header('Location: /');
    }

    static public function ssl_crypt($data)
    {
        $method = 'aes-256-cbc';
        $key = getenv('CRYPTO_KEY');
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));

        $encrypted = openssl_encrypt($data, $method, $key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
    }

    static public function ssl_decrypt($data)
    {
        $method = 'aes-256-cbc';
        $key = getenv('CRYPTO_KEY');
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);

        return openssl_decrypt($encrypted_data, $method, $key, 0, $iv);
    }
}
