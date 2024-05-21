<?php

class RegisterService
{
    public function __construct(
        private string $name,
        private string $email,
        private string $password
    ) {
        $this->validateData();
    }

    public function register()
    {
        try {
            $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);

            UserModel::createUser($this->name, $this->email, $passwordHash);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    private function validateData()
    {
        $this->validateUserName();
        $this->validateEmail();
        $this->validatePassword();
    }

    private function validateUserName()
    {
        if (empty($this->name)) {
            throw new Exception("O campo nome não pode estar vazio.");
        }

        if (strlen($this->name) > 100) {
            throw new Exception("O campo não pode ultrapassar 100 caracteres.");
        }
    }

    private function validateEmail()
    {
        if (empty($this->email)) {
            throw new Exception("O campo email não pode estar vazio.");
        }

        if (strlen($this->email) > 100) {
            throw new Exception("O campo não pode ultrapassar 100 caracteres");
        }
    }

    private function validatePassword()
    {
        if (empty($this->password)) {
            throw new Exception("O campo senha não pode estar vazio");
        }

        if (strlen($this->password) > 250) {
            throw new Exception("O campo não pode ultrapassar 250 caracteres");
        }
    }
}
