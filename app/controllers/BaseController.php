<?php

namespace calendar_generator\Controllers;

class BaseController
{
    public function view(string $view, array $params = [])
    {
        // check if $view is a string
        if (!is_string($view)) {
            die("Is not string: $view.");
        }

        // check if $params is a array
        if (!is_array($params)) {
            die("Is not string: $view.");
        }

        extract($params, EXTR_OVERWRITE);

        // check if file exists
        if (!file_exists("../app/views/$view.php")) {
            die("File not exists: $view.");
        }
        
        // return the view
        require_once("../app/views/$view.php");
    }
}
