<?php
namespace App\Middleware;

class ValidationMiddleware
{
    public static function validateRegister($data)
    {
        $errors = [];

        if (empty(trim($data['name']))) {
            $errors['name'] = "O nome não pode estar vazio.";
        }

        if (empty(trim($data['email']))) {
            $errors['email'] = "O e-mail não pode estar vazio.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "O e-mail não é válido.";
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

    public static function validateLogin($data)
    {
        $errors = [];

        if (empty(trim($data['email']))) {
            $errors['email'] = "O e-mail não pode estar vazio.";
        }
        if (empty(trim($data["password"]))) {
            $errors['password'] = "A senha não pode estar vazia.";
        }

        return $errors;
    }

    public static function validateEmail($data)   
    {
        $errors = [];
        if (empty(trim($data["email"]))) {
            $errors["email"] = "O e-mail não pode estar vazio.";
        } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "O e-mail não é válido.";
        }

        return $errors;
    }

    public static function validatePassword($data)
    {
        $errors = [];
        if (empty(trim($data["password"]))) {
            $errors["password"] = "A senha não pode estar vazia.";
        } elseif (strlen($data["password"]) < 10) {
            $errors["password"] = "A senha deve ter pelo menos 10 caracteres.";
        }

        if (empty(trim($data['password-confirm']))) {
            $errors['password-confirm'] = "A confirmação de senha não pode estar vazia.";
        } elseif ($data['password'] !== $data['password-confirm']) {
            $errors['password-confirm'] = "As senhas não coincidem.";
        }

        return $errors;
    }
}
