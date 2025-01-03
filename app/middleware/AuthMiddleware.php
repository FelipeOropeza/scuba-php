<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function __invoke($request, $response, $next) {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            exit;
        }

        return $next($request, $response);
    }
    
}