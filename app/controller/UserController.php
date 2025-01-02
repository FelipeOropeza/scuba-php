<?php

namespace App\Controller;

use App\Middleware\ValidationMiddleware;
use App\Services\MailService;
use App\Model\UserModel;
use App\DAO\UserDAO;

class UserController extends BaseController
{
    static public function do_register()
    {
        $errors = $_SESSION['errors'] ?? [];
        $person = $_SESSION['person'] ?? null;

        unset($_SESSION['errors']);
        unset($_SESSION['person']);

        self::render('register', ['errors' => $errors, 'person' => $person]);
    }

    static public function registerCreate()
    {
        try {
            $person = $_POST['person'] ?? null;

            if ($person) {
                $errors = ValidationMiddleware::validateRegister($person);

                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['person'] = $person;

                    header('Location: /register');
                    exit();
                }

                $idRadom = rand(1, 100);
                $userDAO = new UserDAO();

                $passwordHash = password_hash($person['password'], PASSWORD_DEFAULT);

                $user = new UserModel(
                    $idRadom,
                    $person['name'],
                    $person['email'],
                    $passwordHash
                );

                if (!$userDAO->insertUser($user)) {
                    $_SESSION['errors'] = ['O email já está em uso. Por favor, escolha outro.'];
                    $_SESSION['person'] = $person;
                    header('Location: /register');
                    exit();
                }

                MailService::sendValidationEmail($person['email']);
                $_SESSION['success_message'] = 'Cadastro realizado com sucesso! Por favor, verifique seu email para confirmar a conta.';
                header('Location: /');
                exit();

            } else {
                echo "Nenhum dado foi enviado.";
                header('Location: /register');
                exit();
            }
        } catch (\InvalidArgumentException $e) {
            $_SESSION['errors'] = [$e->getMessage()];
            self::render('register', ['errors' => $_SESSION['errors']]);
        }
    }

    static public function do_login()
    {   
        $success_message = $_SESSION['success_message'] ?? '';
        unset($_SESSION['success_message']);
        self::render('login', ['success_message' => $success_message]);
    }
}
