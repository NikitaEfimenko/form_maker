<?php

namespace views;
use core\View;

class FormView extends View {
    public function index($args) {
        return $this->render(__DIR__."/../templates/form.template.php", [
            "FORMS" => $args["FORMS"],
            "UID" => $args["UID"]
        ]);
    }
} 