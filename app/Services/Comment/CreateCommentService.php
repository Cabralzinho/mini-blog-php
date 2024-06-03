<?php

class CreateCommentService
{
    public function __construct(
        private string $title,
        private string $content,
        private int $post_id,
        private int $creator_id
    ) {
        $this->validateData();
    }

    public function create()
    {
        try {
            CommentModel::createComment(
                $this->title,
                $this->content,
                $this->post_id,
                $this->creator_id
            );
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    private function validateData()
    {
        $this->validateTitle();
        $this->validateContent();
    }

    private function validateTitle()
    {
        if (empty($this->title)) {
            throw new Exception("O campo título não pode estar vazio.");
        }

        if (strlen($this->title) > 200) {
            throw new Exception("O campo título não pode ultrapassar 200 caracteres");
        }
    }

    private function validateContent()
    {
        if (empty($this->content)) {
            throw new Exception("O campo mensagem não pode estar vazio");
        }

        if (strlen($this->content) > 1000) {
            throw new Exception("O campo mensagem não pode ultrapassar 1000 caracteres");
        }
    }
}
