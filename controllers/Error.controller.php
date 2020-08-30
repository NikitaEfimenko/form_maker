<?php

namespace controllers;
use core\Controller;
use views\ErrorView;

class ErrorController extends Controller {
    public function bootstrap($view_args) {
        $code = NULL;
        if (!!isset($view_args['code'])) {
            $code = $view_args['code'];
        }
        $view = new ErrorView();
        switch($code) {
            case 404: print($view->index(["code" => 404]));
            default: print($view->index(["code" => 418]));
        }
    }
}
