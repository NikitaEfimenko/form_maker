<?php

namespace controllers;
use core\Controller;
use views\MainView;
use core\Router;
use models\Store;
use models\TextField;
use models\VControl;

class MainController extends Controller {
    public function bootstrap($view_args) {
        $action_name = (isset($view_args[0])) ? $view_args[0] : null;
        $view = new MainView();
        $this->doAction($action_name);
        $props = ["FORMS" => array_map(function ($el) {
            $args = explode(",", $el);
            $class = "models\\".VControl::getClass($args[0]);
            $input = new $class(...$args);
            return $input->render();
        }, Store::get('test'))];
        print($view->index($props));
    }

    public function add() {
        if (isset($_POST['type']) && isset( $_POST['label'])) {
            $tmp = $_POST['type'].",".$_POST['label'];
            Store::set('test', $tmp);
        }
        Router::redirect('/builder');
    }
    public function reset() {
        Store::remove('test');
        Router::redirect('/builder');
    }
    public function publish() {
        if (isset($_POST['email'])) {
            //Store::publish('test', $_POST['email']);
            Router::redirect('/form/test');
        }
        Router::redirect('/builder');
    }
}
