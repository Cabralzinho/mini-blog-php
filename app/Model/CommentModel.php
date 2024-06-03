<?php

class CommentModel
{
    public static function getCommentsByPostId($post_id)
    {
        $connection = DataBase::getConnection();

        $query = "SELECT
                c.id AS comment_id,
                c.title AS comment_title,
                c.content AS comment_content,
                c.created_at AS comment_created_at,
                u.name AS author_name,
                u.id AS author_id
            FROM
                comments c
            LEFT JOIN
                user u ON u.id = c.creator_id
            WHERE
                c.post_id = :post_id
            ORDER BY c.id DESC";
            
        $query = $connection->prepare($query);
        $query->execute([
            ":post_id" => $post_id
        ]);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function createComment(string $title, string $content, int $post_id, int $creator_id)
    {
        $connection = DataBase::getConnection();

        $query = "INSERT INTO comments(title, content, post_id, creator_id)VALUES(:title, :content, :post_id, :creator_id)";
        $query = $connection->prepare($query);
        $query->execute([
            ":title" => $title,
            ":content" => $content,
            ":post_id" => $post_id,
            ":creator_id" => $creator_id
        ]);
    }
}
