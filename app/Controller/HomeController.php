<?php

class HomeController
{
    public function index()
    {
        try {
            $getPostService = new GetPostsService();
            $allPosts = $getPostService->getPosts();

            $loader = new \Twig\Loader\FilesystemLoader('../app/View');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal("error", $_GET["error"]);
            $twig->addGlobal("session", [
                "id" => $_SESSION["id"],
                "name" => $_SESSION["name"]
            ]);

            $template = $twig->load("home.html");

            $parameters["posts"] = $allPosts;

            $conteudo = $template->render($parameters);

            echo $conteudo;
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?page=home&error=$error");
        }
    }

    public function destroy()
    {
        session_destroy();

        header("Location: /");
    }

    public function post()
    {
        try {
            $service = new CreatePostService(
                $_POST["title"],
                $_POST["content"],
                $_SESSION["id"]
            );

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
            $service = new EditPostService(
                $_GET["id"],
                $_POST["title"],
                $_POST["content"]
            );

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
                $_POST["contentComment"],
                $_GET["postId"],
                $_SESSION["id"]
            );

            $service->create();

            return header("Location: ?page=home");
        } catch (Exception $error) {
            $error = $error->getMessage();
            return header("Location: ?page=home&error=$error");
        }
    }
}
