<?php

class GetPostsService
{
    public function __construct()
    {
        $this->validateData();
    }

    public function getPosts()
    {
        try {
            $postsInfo = PostModel::getPosts();
            $posts = [];

            for ($i = 0; $i < count($postsInfo); $i++) {
                $post = $postsInfo[$i];
                $comments = CommentModel::getCommentsByPostId($post["id"]);

                $posts[] = [
                    "id" => $post["id"],
                    "author" => ["id" => $post["author_id"],"name" => $post["author_name"]],
                    "title" => $post["title"],
                    "content" => $post["content"],
                    "created_at" => $post["created_at"],
                    "comments" => $comments
                ];
            };

            return $posts;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    private function validateData()
    {
        $this->validateSession();
    }

    private function validateSession()
    {
        if (!isset($_SESSION["id"])) {
            header("Location: /");
        }
    }
}
