<?php

namespace views;
use core\View;


class MainView extends View {
    public function index($args) {
        return $this->render(__DIR__."/../templates/main.template.php", [
            "FORMS" => $args["FORMS"]
        ]);
    }
} 