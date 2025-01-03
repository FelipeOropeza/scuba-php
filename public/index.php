<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

$dispatcher = FastRoute\simpleDispatcher(require __DIR__ . '/../app/routes/routes.php');

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        \App\Controller\BaseController::render('not_found');
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo "405 - Método não permitido";
        break;

    case FastRoute\Dispatcher::FOUND:
        [$controller, $method] = $routeInfo[1];
        if ($uri === '/home') {
            (new \App\Middleware\AuthMiddleware)($_REQUEST, $_SESSION, function($request, $response) use ($controller, $method, $routeInfo) {
                call_user_func([new $controller(), $method], ...$routeInfo[2]);
            });
        } else {
            // Executa a rota normalmente se não for '/home'
            call_user_func([new $controller(), $method], ...$routeInfo[2]);
        }
        break;
}
