<?php

class Core
{
    public function __construct()
    {
        session_start();
    }

    public function start($urlGet)
    {
        $action = "index";
        $controller = "LoginController";

        if (isset($urlGet["method"])) {
            $action = $urlGet["method"];
        }

        if (isset($urlGet["page"])) {
            $controller = ucfirst($urlGet["page"] . "Controller");
        }

        if (!class_exists($controller)) {
            $controller = "ErrorController";
        }

        call_user_func_array([
            new $controller, $action
        ], []);
    }
}
