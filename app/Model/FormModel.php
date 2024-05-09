<?php

class FormModel
{
    public static function registerUser()
    {
        if (empty($_POST["name"]) || empty($_POST["password"]) || empty($_POST["password"])) {
            throw new Exception("O campo não pode está vazio!");
        }

        $connection = Database::getConnection();

        $querySearch = "SELECT * FROM user WHERE email = :email";
        $querySearch = $connection->prepare($querySearch);
        $querySearch->execute([":email" => $_POST["email"]]);

        if ($querySearch->rowCount() > 0) {
            throw new Exception("Conta já existente");
        }

        $queryRegister = "INSERT INTO user(name, email, password)VALUES(:name, :email, :password)";
        $queryRegister = $connection->prepare($queryRegister);

        $queryRegister->execute([
            ":name" => $_POST["name"],
            ":email" => $_POST["email"],
            ":password" => $_POST["password"]
        ]);

        return;
    }

    public static function loginUser() {
        if(empty($_POST["email"]) || empty($_POST["password"])) {
            throw new Exception("O campo não pode está vazio!");
        }

        $connection = Database::getConnection();

        $query = "SELECT * FROM user where email = :email AND password = :password";
        $query = $connection->prepare($query);
        $query->execute([
            ":email" => $_POST["email"],
            ":password" => $_POST["password"]
        ]);

        if ($query->rowCount() == 0) {
            throw new Exception("Email ou senha inserido incorretamente");
        }

        return;
    }
}
