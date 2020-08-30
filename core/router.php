<?php
namespace core;

 class Router {
    private static $routes = [];
    private static $middleware = [];
    private static $current = "/";
    function __construct() {}
    function __destruct() {}

    public static function apply($cb) {
        array_push(self::$middleware, $cb);
    }

    public static function current($path) {
        return self::$current === $path;
    }

    public static function redirect($path, $permanent = true) {
        header('Location: '.$path, true, $permanent ? 301 : 302);
        exit();
    }

    public static function route($pattern, $callback) {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $callback;
    }

    public function getFacade() {
        return self;
    }

    public static function run($server, $session) {
        $uri = $server['REQUEST_URI'];
        self::$current = $uri;
        $params = array_reduce(self::$middleware,function ($acc, $f) {
            return $f($acc);
        }, [$server, $session]);
        foreach(self::$routes as $route => $callback) {
            if ($route === '/^*$/' || preg_match($route, $uri, $params)) {
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
            }
        }
    }

 }
?>