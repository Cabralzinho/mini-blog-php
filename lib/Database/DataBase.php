<?php

class DataBase
{
    public static function getConnection()
    {
        try {
            $connection = new PDO("mysql:host=127.0.0.1;dbname=blog_php", "root", "");

            return $connection;
        } catch (PDOException $error) {
            echo "Algo deu errado: {$error->getMessage()}";
        }
    }
}
