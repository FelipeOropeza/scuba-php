<?php

use App\Controller\Controller;

$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        Controller::do_login();
        break;
    case 'register':
        Controller::do_register();
        break;
    default:
        Controller::do_not_found();
        break;
}