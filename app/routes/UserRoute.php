<?php

use App\Controller\UserController;

$r->addRoute('GET', '/', [UserController::class, 'do_login']);
$r->addRoute('POST', '/login/check', [UserController::class, 'loginCheck']);

$r->addRoute('GET', '/register', [UserController::class, 'do_register']);
$r->addRoute('POST', '/register/create', [UserController::class, 'registerCreate']);

$r->addRoute('GET', '/change-password/{token}', [UserController::class, 'do_change_password']);
$r->addRoute('POST', '/changePassword/{token}', [UserController::class, 'changePassword']);

$r->addRoute('GET', '/forget-password', [UserController::class,  'do_forget_password']);
$r->addRoute('POST', '/forgetSenha', [UserController::class,  'forgetSenha']);

$r->addRoute('GET', '/logout', [UserController::class, 'do_logout']);

$r->addRoute('GET','/delete-account', [UserController::class, 'deleteAccount']);

$r->addRoute('GET', '/home', [UserController::class, 'do_home']);
