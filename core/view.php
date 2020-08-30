<?php

namespace core;

abstract class View {
    private static $layout = 'default';
    function __construct() {}
    function __destruct() {}
    
    private static function pre_render($file, $args) {
        if (!file_exists($file)) {
            return '';
        }
        if (is_array($args)) {
            extract($args);
        }
        ob_start();
        include $file;
        return ob_get_clean();
    }

    protected static function configureLayoutPath($path) {
        return __DIR__."/../".$path.".layout.php";
    }

    abstract public function index($args);

    public static function render($file, $args) {
        $content = self::pre_render($file, $args);
        return self::pre_render(self::configureLayoutPath(self::$layout), [
            "CONTENT" => $content
        ]);

    }
}