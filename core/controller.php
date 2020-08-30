<?php 

namespace core;
use core\Router;
use core\View;

abstract class Controller {
    private $view_data;
    function ___construct($view_data) {
        $this->view_data = $view_data;
    }
    abstract public function bootstrap($args);

    public function doAction($name) {
        if (method_exists($this, $name)) {
            $this->$name();
        }
    } 
}