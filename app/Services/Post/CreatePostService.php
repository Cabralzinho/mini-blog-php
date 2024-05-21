<?php

class CreatePostService
{
    public function __construct(private string $title, private string $message)
    {
        $this->validateData();
    }

    public function create()
    {
        try {
            PostModel::createPost($this->title, $this->message);
        }
        catch (Exception $error) {
            throw new Exception("Erro ao se comunicar com o banco de dados: $error");
        }
    }
    
    private function validateData()
    {
        $this->validateTitle();
        $this->validateMessage();
    }

    private function validateTitle()
    {
        if (empty($this->title)) {
            throw new Exception("O título não pode estar vazio.");
        }

        if(strlen($this->title) > 250) {
            throw new Exception("O título não pode ser maior que 250 caracteres.");
        }
    }

    private function validateMessage() {
        if (empty($this->message)) {
            throw new Exception("A mensagem não pode estar vazia.");
        }

        if (strlen($this->message) > 250) {
            throw new Exception("A mensagem não pode ultrapassar 250 caracteres");
        }
    }

}
