<?php

class PostModel
{
    public static function createPost(string $title, string $content, int $userId)
    {
        $connection = Database::getConnection();

        $query = "INSERT INTO post(title, content, user_id)VALUES(:title, :content, :user_id)";
        $query = $connection->prepare($query);
        $query->execute([
            ":title" => $title,
            ":content" => $content,
            ":user_id" => $userId
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

    public static function editPost($id, $title, $content)
    {
        $connection = DataBase::getConnection();

        $query = "UPDATE post SET title = :title, content = :content WHERE id = :id";
        $query = $connection->prepare($query);
        $query->execute([
            ":id" => $id,
            ":title" => $title,
            ":content" => $content,
        ]);
    }

    public static function getPosts()
    {
        $connection = DataBase::getConnection();

        $query = "SELECT
            u.name AS author_name,
            u.id AS author_id,
            p.id,
            p.title,
            p.content,
            p.created_at
        FROM
            user u
        RIGHT JOIN post p ON
            u.id = p.user_id
        ORDER BY
            p.id DESC";
        $query = $connection->prepare($query);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
