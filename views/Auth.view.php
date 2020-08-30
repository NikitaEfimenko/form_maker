<?php

namespace views;
use core\View;

class AuthView extends View {
    public function index($args) {
        return $this->render(__DIR__."/../templates/auth.template.php", []);
    }
} 