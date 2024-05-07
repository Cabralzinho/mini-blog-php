<?php

class DataBase
{
    public static function getConnection()
    {
        try {
            $conexao = new PDO("mysql:host=127.0.0.1;dbname=user", "root", "");

            return $conexao;
        } catch (PDOException $error) {
            echo "Algo deu errado: {$error->getMessage()}";
        }
    }
}
