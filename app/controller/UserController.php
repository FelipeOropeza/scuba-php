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

        unset($_SESSION['user']);
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
                    $_SESSION['errors']['email'] = 'O email já está em uso. Por favor, escolha outro.';
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
        $errors = $_SESSION['errors'] ?? [];
        $success_message = $_SESSION['success_message'] ?? '';
        $person = $_SESSION['person'] ?? null;

        unset($_SESSION['user']);
        unset($_SESSION['person']);
        unset($_SESSION['errors']);
        unset($_SESSION['success_message']);


        self::render('login', ['success_message' => $success_message, 'errors' => $errors, 'person' => $person]);
    }

    static public function loginCheck()
    {
        try {
            $person = $_POST['person'] ?? null;

            if ($person) {
                $errors = ValidationMiddleware::validateLogin($person);

                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['person'] = $person;

                    header('Location: /');
                    exit();
                }

                $userDAO = new UserDAO();
                $user = $userDAO->getUserByEmail($person['email']);
                if (!$user) {
                    $_SESSION['errors']['email'] = 'Email não validado. Verifique seu e-mail para ativar a conta.';
                    $_SESSION['person'] = $person;
                    header('Location: /');
                    exit();
                }

                if (password_verify($person['password'], $user->getPassword())) {

                    $userArray = [
                        'id' => $user->getId(),
                        'name' => $user->getName(),
                        'email' => $user->getEmail(),
                    ];

                    $_SESSION['user'] = $userArray;
                    header('Location: /home');
                    exit();
                } else {
                    $_SESSION['errors']['password'] = 'Senha incorreta.';
                    $_SESSION['person'] = $person;
                    header('Location: /');
                    exit();
                }

            } else {
                echo "Nenhum dado foi enviado.";
                header('Location: /');
                exit();
            }
        } catch (\InvalidArgumentException $e) {
            $_SESSION['errors'] = [$e->getMessage()];
            self::render('register', ['errors' => $_SESSION['errors']]);
        }
    }

    static public function do_home()
    {
        $errors = $_SESSION['errors'] ?? [];
        $sucess_message = $_SESSION['success_message'] ?? '';
        $user = $_SESSION['user'] ?? null;
        self::render('home', ['user' => $user, 'errors' => $errors, 'success_message' => $sucess_message]);
    }

    static public function do_logout()
    {
        unset($_SESSION['user']);
        header('Location: /');
        exit();
    }

    static public function deleteAccount()
    {
        $user = $_SESSION['user'] ?? null;

        $userDAO = new UserDAO();
        $userDAO->deleteUserById($user['id']);

        $_SESSION['success_message'] = 'Sua conta foi excluida.';

        header('Location: /');
        exit();
    }

    static public function do_change_password($token)
    {
        $errors = $_SESSION['errors'] ?? [];
        $person = $_SESSION['person'] ?? null;

        unset($_SESSION['person']);
        unset($_SESSION['errors']);

        $decodedToken = base64_decode($token);
        list($date, $email) = explode('|', $decodedToken);

        $currentDate = date('Y-m-d');
        if ($date !== $currentDate) {
            $_SESSION['errors']['email'] = 'O token do email: ' . $email . ' expirou.';
            header('Location: /forget-password');
            exit;
        }

        self::render('change_password', ['token' => $token, 'email' => $email, 'errors' => $errors, 'person' => $person]);
    }

    static public function changePassword($token){
        try {
            $person = $_POST['person'] ?? null;

            if ($person) {
                $errors = ValidationMiddleware::validatePassword($person);

                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['person'] = $person;

                    header('Location: /change-password' . '/' . $token);
                    exit();
                }

                var_dump($person['password']);
                $passwordHash = password_hash($person['password'], PASSWORD_DEFAULT);
                $userDAO = new UserDAO();

                $userDAO->updatePasswordByEmail($person['email'], $passwordHash);

                $_SESSION['success_message'] = 'Senha alterada com sucesso!';
                header('Location: /');

            } else {
                echo "Nenhum dado foi enviado.";
                header('Location: /change-password' . '/' . $token);
                exit();
            }
        } catch (\InvalidArgumentException $e) {
            $_SESSION['errors'] = [$e->getMessage()];
            self::render('register', ['errors' => $_SESSION['errors']]);
        }
    }

    static public function do_forget_password()
    {
        $success_message = $_SESSION['success_message'] ?? '';
        $errors = $_SESSION['errors'] ?? [];

        unset($_SESSION['success_message']);
        unset($_SESSION['errors']);

        self::render('forget_password', ['success_message' => $success_message, 'errors' => $errors]);
    }

    static public function forgetSenha()
    {
        try {
            $person = $_POST['person'] ?? null;

            if ($person) {
                $errors = ValidationMiddleware::validateEmail($person);

                if (!empty($errors)) {
                    $_SESSION['errors'] = $errors;
                    $_SESSION['person'] = $person;

                    header('Location: /forget-password');
                    exit();
                }

                $userDAO = new UserDAO();

                $user = $userDAO->getUserByEmail($person['email']);
                if (!$user) {
                    $_SESSION['errors']['email'] = 'Email não encontrado.';
                    $_SESSION['person'] = $person;
                    header('Location: /forget-password');
                    exit();
                }

                MailService::sendForgetPasswordEmail($person['email']);
                $_SESSION['success_message'] = 'Um link de redefinição de senha foi enviado para o seu email.';
                header('Location: /forget-password');
                exit();

            } else {
                echo "Nenhum dado foi enviado.";
                header('Location: /forget-password');
                exit();
            }
        } catch (\InvalidArgumentException $e) {
            $_SESSION['errors'] = [$e->getMessage()];
            self::render('forget_password', ['errors' => $_SESSION['errors']]);
        }
    }
}
