<?php

use FastRoute\RouteCollector;

return function(RouteCollector $r) {
    require_once __DIR__ . '/UserRoute.php';
    require_once __DIR__ . '/MailRoute.php';
};
