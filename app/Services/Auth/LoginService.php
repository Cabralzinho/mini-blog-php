<?php

class LoginService
{
    public function __construct(private string $email, private string $password)
    {
        $this->validateData();
    }

    public function login()
    {    
        $user = UserModel::findUserByEmail($this->email);
        
        if (empty($user)) {
            throw new Exception("Usuário não existe.");
        }

        $isPasswordMatch = password_verify($this->password, $user["password"]);

        if (!$isPasswordMatch) {
            throw new Exception("A senha não coincide.");
        };

        $_SESSION["name"] = $user["name"];
        $_SESSION["id"] = $user["id"];
    }

    private function validateData()
    {
        $this->validadeEmail();
        $this->validadePassword();
    }

    private function validadeEmail()
    {
        if (empty($this->email)) {
            throw new Exception("O campo email não pode estar vazio.");
        }

        if (strlen($this->email) > 100) {
            throw new Exception("O campo não pode ultrapassar 100 caracteres.");
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("O email informado não é válido.");
        }
    }

    private function validadePassword()
    {
        if (empty($this->password)) {
            throw new Exception("O campo da senha não pode estar vazio.");
        }

        if (strlen($this->password) > 250) {
            throw new Exception("O campo não pode ultrapassar 250 caracteres.");
        }
    }
}
