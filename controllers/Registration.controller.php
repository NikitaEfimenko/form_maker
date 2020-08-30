<?php

namespace controllers;
use core\Controller;
use views\RegistrationView;

class RegistrationController extends Controller {
    public function bootstrap($view_args) {
        $view = new RegistrationView();
        print($view->index($view_args));
    }
}
