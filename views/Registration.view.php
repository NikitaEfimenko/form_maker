<?php

namespace views;
use core\View;

class RegistrationView extends View {
    public function index($args) {
        return $this->render(__DIR__."/../templates/registration.template.php", []);
    }
} 