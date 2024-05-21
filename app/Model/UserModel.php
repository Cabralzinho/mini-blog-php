<?php

class UserModel
{
    public static function createUser(string $name, string $email, string $password)
    {
        try {
            $connection = Database::getConnection();

            $queryRegister = "INSERT INTO user(name, email, password) 
                VALUES(:name, :email, :password)";
            $queryRegister = $connection->prepare($queryRegister);

            $queryRegister->execute([
                ":name" => $name,
                ":email" => $email,
                ":password" => $password
            ]);
        } catch (PDOException $error) {
            throw new Exception(
                "Ocorreu um erro ao tentar criar o usuario no banco de dados"
            );
        }
    }

    public static function findUserByEmail(string $email) {
        try {
            $connection = Database::getConnection();
            $query = "SELECT * FROM user WHERE email = :email";

            $findUser = $connection->prepare($query);
            $findUser->execute([":email" => $email]);

            return $findUser->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $error) {
            throw new Exception(
                "Ocorreu um erro ao logar o usuário no banco de dados"
            );
        }
    }
}
