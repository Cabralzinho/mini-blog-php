<?php

class Core
{
    public function start($urlGet)
    {
        if (isset($urlGet["method"])) {
            $action = $urlGet["method"];
        }
        else {
            $action = "index";
        }

        if (isset($urlGet["page"])) {
            $controller = ucfirst($urlGet["page"] . "Controller");
        } else {
            $controller = "LoginController";
        }

        if (!class_exists($controller)) {
            $controller = "ErrorController";
        }

        call_user_func_array([
            new $controller, $action
        ], []);
    }
}
