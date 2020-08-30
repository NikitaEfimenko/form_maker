<?php

namespace views;
use core\View;

class ErrorView extends View {
    public function index($args) {
        return $this->render(__DIR__."/../templates/404.template.php", []);
    }
} 