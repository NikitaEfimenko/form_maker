<?php

ini_set("display_errors", 1);
require_once './vendor/autoload.php';
include 'core/bootstrap.php';
include 'models/Form.model.php';

use core\Router;

session_start();
Router::apply(function () {
  $args = func_get_args();
  //if (!isset($session['token']) && !Router::current('/auth')) Router::redirect('/auth');
  return $args;
});

Router::route('/builder/(\w*)', function () {
  $view_data = func_get_args();
  $controller = new \controllers\MainController();
  $controller->bootstrap($view_data);
});


Router::route('/builder', function () {
  $view_data = func_get_args();
  $controller = new \controllers\MainController();
  $controller->bootstrap($view_data);
});

Router::route('/form/(\w+)', function () {
  $view_data = func_get_args();
  $controller = new \controllers\FormController();
  $controller->bootstrap($view_data);
});

Router::route('/form/(\w+)/(\w+)', function () {
  $view_data = func_get_args();
  $controller = new \controllers\FormController();
  $controller->bootstrap($view_data);
});


Router::route('/auth', function () {
  $view_data = func_get_args();
  $controller = new \controllers\AuthController();
  $controller->bootstrap($view_data);
});

Router::route('/registration', function () {
  $view_data = func_get_args();
  $controller = new \controllers\RegistrationController();
  $controller->bootstrap($view_data);
});

Router::route('*', function () {
  $view_data = func_get_args();
  $controller = new \controllers\ErrorController();
  $controller->bootstrap($view_data);
});

Router::run($_SERVER, $_SESSION);
