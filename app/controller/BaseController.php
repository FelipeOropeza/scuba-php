<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class BaseController
{
    protected static $twig;

    public static function init()
    {
        $loader = new FilesystemLoader(VIEW_FOLDER);
        self::$twig = new Environment($loader, [
            'cache' => false,
            'auto_reload' => true,
        ]);
    }

    public static function render($template, $params = [])
    {
        if (!self::$twig) {
            self::init();
        }

        echo self::$twig->render($template . ".twig", $params);
    }
}
