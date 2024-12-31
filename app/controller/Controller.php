<?php

namespace App\Controller;

use App\Utils\RenderView;

class Controller
{
    static public function do_register()
    {
        RenderView::render_view("register");
    }

    static public function do_login()
    {
        RenderView::render_view("login");
    }

    static public function do_not_found() {
        RenderView::render_view("not_found");
    }
}
