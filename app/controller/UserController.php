<?php

namespace App\Controller;

use App\Utils\RenderView;
use App\Model\UserModel;
use App\DAO\UserDAO;

class UserController
{
    static public function do_register()
    {
        RenderView::render_view("register");
    }

    static public function do_registerPost()
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
    }

    static public function do_login()
    {
        RenderView::render_view("login");
    }

    static public function do_not_found()
    {
        RenderView::render_view("not_found");
    }
}
