<?php

use App\Controller\UserController;

$r->addRoute('GET', '/', [UserController::class, 'do_login']);
$r->addRoute('GET','/register', [UserController::class, 'do_register']);
