<?php

use App\Controller\UserController;

$page = $_GET['page'] ?? 'login';
$from = $_GET['from'] ?? null;

switch ($page) {
    case 'login':
        UserController::do_login();
        break;
    case 'register':
        if ($from == 'register') {
            UserController::do_registerPost();
            break;
        }
        UserController::do_register();
        break;
    default:
        UserController::do_not_found();
        break;
}
