<?php

class LoginController
{
    public function index()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);
        $twig->addGlobal("error", $_GET["error"]);

        $template = $twig->load("login.html");
        $conteudo = $template->render();

        echo $conteudo;
    }

    public function login()
    {
        try {
            $service = new LoginService(
                $_POST["email"],
                $_POST["password"]
            );

            $service->login();

            return header("Location: ?page=home");
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?error=$error");
        }
    }
}
