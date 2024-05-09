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
            FormModel::loginUser();

            echo "Logado com sucesso meu gostoso";
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?error=$error");
        }
    }
}
