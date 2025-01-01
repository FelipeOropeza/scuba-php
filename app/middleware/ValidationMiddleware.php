<?php
namespace App\Middleware;

use App\DAO\UserDAO;

class ValidationMiddleware
{
    public static function validateRegister($data)
    {
        $errors = [];
        
        $userDAO = new UserDAO();
        $usuarios = json_decode(file_get_contents(DATA_LOCATION), true);
        
        if (empty(trim($data['name']))) {
            $errors['name'] = "O nome não pode estar vazio.";
        }

        if (empty(trim($data['email']))) {
            $errors['email'] = "O e-mail não pode estar vazio.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "O e-mail não é válido.";
        } elseif ($userDAO->emailExists($data['email'], $usuarios)) {
            $errors['email'] = "O e-mail já está em uso.";
        }

        if (empty(trim($data['password']))) {
            $errors['password'] = "A senha não pode estar vazia.";
        } elseif (strlen($data['password']) < 10) {
            $errors['password'] = "A senha deve ter pelo menos 10 caracteres.";
        }

        if (empty(trim($data['password-confirm']))) {
            $errors['password-confirm'] = "A confirmação de senha não pode estar vazia.";
        } elseif ($data['password'] !== $data['password-confirm']) {
            $errors['password-confirm'] = "As senhas não coincidem.";
        }

        return $errors;
    }
}
