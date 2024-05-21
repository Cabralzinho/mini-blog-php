<?php

class EditPostService
{
    public function __construct(
        private string $id,
        private string $title,
        private string $message
    ) {
        $this->validateData();
    }

    private function validateData()
    {
        $this->validateTitle();
        $this->validateMessage();
    }

    public function edit()
    {
        try {
            PostModel::editPost($this->id, $this->title, $this->message);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    private function validateTitle()
    {
        if (empty($this->title)) {
            throw new Exception("O campo título não pode estar vazio.");
        }

        if (strlen($this->title) > 200) {
            throw new Exception("O campo não pode ultrapassar 200 caracteres");
        }
    }

    private function validateMessage()
    {
        if (empty($this->message)) {
            throw new Exception("O campo mensagem não pode estar vazio.");
        }

        if (strlen($this->message) > 1000) {
            throw new Exception("O campo não pode ultrapassar 1000 caracteres");
        }
    }
}
