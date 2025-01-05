<?php

use App\Controller\UserController;

$r->addRoute('GET', '/', [UserController::class, 'do_login']);
$r->addRoute('POST', '/login/check', [UserController::class, 'loginCheck']);

$r->addRoute('GET', '/register', [UserController::class, 'do_register']);
$r->addRoute('POST', '/register/create', [UserController::class, 'registerCreate']);

$r->addRoute('GET', '/logout', [UserController::class, 'do_logout']);

$r->addRoute('GET','/delete-account', [UserController::class, 'deleteAccount']);

$r->addRoute('GET', '/home', [UserController::class, 'do_home']);
