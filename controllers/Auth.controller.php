<?php

namespace controllers;
use core\Controller;
use views\AuthView;
use core\Router;

class AuthController extends Controller {
    public function bootstrap($view_args) {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            return Router::redirect('/');
        } else if (!isset($_POST['login'])){
            return Router::redirect('/registration');
        }
        $view = new AuthView();
        print($view->index($view_args));
    }
}
