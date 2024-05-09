<?php 

class ErrorController {
    public function index() {
        $loader = new \Twig\Loader\FilesystemLoader('../app/View');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load("error.html");
        $conteudo = $template->render();

        echo $conteudo;
    }
}