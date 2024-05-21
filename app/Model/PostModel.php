<?php

class PostModel
{
    public static function createPost(string $title, string $message)
    {
        $connection = Database::getConnection();

        $query = "INSERT INTO post(title, message)VALUES(:title, :message)";
        $query = $connection->prepare($query);
        $query->execute([
            ":title" => $title,
            ":message" => $message,
        ]);
    }

    public static function deletePost()
    {
        $connection = Database::getConnection();

        $query = "DELETE FROM post WHERE id = :id";
        $query = $connection->prepare($query);
        $query->execute([
            ":id" => $_GET["id"]
        ]);
    }

    public static function editPost($id, $title, $message)
    {
        $connection = DataBase::getConnection();

        $query = "UPDATE post SET title = :title, message = :message WHERE id = :id";
        $query = $connection->prepare($query);
        $query->execute([
            ":id" => $id,
            ":title" => $title,
            ":message" => $message,
        ]);
    }

    public static function viewPost()
    {
        $connection = DataBase::getConnection();

        $query = "SELECT * FROM post ORDER BY id DESC";
        $query = $connection->prepare($query);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function viewComment() {
        $connection = DataBase::getConnection();
        
        $query = "SELECT * FROM comments ORDER BY id DESC";
        $query = $connection->prepare($query);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function createComment(string $title, string $message) {
        $connection = DataBase::getConnection();

        $query = "INSERT INTO comments(post_id, title, message)VALUES(:post_id, :title, :message)";
        $query = $connection->prepare($query);
        $query->execute([
            ":post_id" => 1,
            ":title" => $title,
            ":message"=> $message,
        ]);
    }
}
