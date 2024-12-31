<?php

namespace App\Utils;

class RenderView {
    static public function render_view($view, $data = []) {
        extract($data);
        echo file_get_contents(VIEW_FOLDER.$view.".view");
    }
}