<?php

namespace App\Controller;

use App\Middleware\ValidationMiddleware;
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
        $successMessage = $_SESSION['success_message'] ?? null;
        unset($_SESSION['success_message']);

        $errorMessage = $_SESSION['error_message'] ?? null;
        unset($_SESSION['error_message']);

        self::render('login', [
            'success_message' => $successMessage,
            'error_message' => $errorMessage,
        ]);
    }


    static public function loginCheck()
    {
        // Verifica se os dados foram enviados via POST
        if (isset($_POST['person'])) {
            $email = $_POST['person']['email'] ?? '';
            $password = $_POST['person']['password'] ?? '';

            // Carrega os dados do arquivo JSON
            $arquivoJson = file_get_contents(DATA_LOCATION);
            $usuarios = json_decode($arquivoJson, true);

            // Verifica se o usuário existe e se a senha está correta
            foreach ($usuarios as $usuario) {
                if ($usuario['email'] === $email) {
                    // Verifica a senha com password_verify
                    if (password_verify($password, $usuario['password'])) {
                        // Login bem-sucedido, redireciona para a página principal
                        $_SESSION['user'] = $usuario; // Salva os dados do usuário na sessão
                        header('Location: /dashboard'); // Redireciona para a página do usuário
                        exit();
                    } else {
                        // Senha incorreta
                        $_SESSION['error_message'] = "Senha incorreta.";
                        header('Location: /login'); // Redireciona para a página de login com erro
                        exit();
                    }
                }
            }

            // Caso o email não tenha sido encontrado
            $_SESSION['error_message'] = "Email não encontrado.";
            header('Location: /login'); // Redireciona para a página de login com erro
            exit();
        }
    }

}
