<?php

class HomeController
{
    public function index()
    {
        try {
            $allPosts = PostModel::viewPost();
            $allComments = PostModel::viewComment();

            $loader = new \Twig\Loader\FilesystemLoader('../app/View');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal("error", $_GET["error"]);

            $template = $twig->load("home.html");

            $parameters["posts"] = $allPosts;
            $parameters["comments"] = $allComments;

            $conteudo = $template->render($parameters);

            echo $conteudo;
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?page=home&error=$error");
        }
    }

    public function post()
    {
        try {
            $service = new CreatePostService($_POST["title"], $_POST["message"]);

            $service->create();

            return header("Location: ?page=home");
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?page=home&error=$error");
        }
    }

    public function edit()
    {
        try {
            $service = new EditPostService($_GET["id"], $_POST["title"], $_POST["message"]);

            $service->edit();

            return header("Location: ?page=home");
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?page=home&error=$error");
        }
    }

    public function delete()
    {
        try {
            PostModel::deletePost();

            return header("Location: ?page=home");
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?page=home&error=$error");
        }
    }

    public function comment()
    {
        try {
            $service = new CreateCommentService(
                $_POST["titleComment"],
                $_POST["messageComment"]
            );

            $service->create();

            return header("Location: ?page=home");
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?page=home&error=$error");
        }
    }
}
