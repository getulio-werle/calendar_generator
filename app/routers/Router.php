<?php

namespace calendar_generator\Routers;

use calendar_generator\Controllers\Main;

class Router
{
    public static function dispatch()
    {
        // standard values
        $http_method = $_SERVER['REQUEST_METHOD'];
        $controller = 'main';
        $method = 'index';

        // get controller
        if (isset($_GET['ct'])) {
            $controller = $_GET['ct'];
        }

        // get method
        if (isset($_GET['mt'])) {
           $method = $_GET['mt'];
        }

        // call the controller with your method
        try {
            $class = "calendar_generator\Controllers\\$controller";
            $object_controller = new $class();
            $object_controller->$method();
        } catch (\Throwable $th) {
            echo $th;
            die('Acesso inválido.');
        }
    }
}
