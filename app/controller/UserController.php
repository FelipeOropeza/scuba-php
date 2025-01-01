<?php

namespace App\Controller;

use App\Utils\RenderView;
use App\Model\UserModel;
use App\DAO\UserDAO;

class UserController extends BaseController
{
    static public function do_register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $person = $_POST['person'] ?? null;

            if ($person) {
                $idRadom = rand(1, 100);

                $userDAO = new UserDAO();
                $user = new UserModel(
                    $idRadom,
                    $person['name'],
                    $person['email'],
                    $person['password']
                );

                if ($userDAO->insertUser($user)) {
                    header('Location: /?page=login');
                } else {
                    echo "Erro ao cadastrar usuário!";
                };
            } else {
                echo "Nenhum dado foi enviado.";
            }
        }
        self::render('register');
    }

    static public function do_login()
    {
        self::render('login');
    }
}
