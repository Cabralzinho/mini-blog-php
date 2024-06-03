<?php 

class GetCommentsService {
    public function __construct(private string $post_id) {
        $this->validateData();
    }

    public function getComments() {
        try {
            $comments = CommentModel::getCommentsByPostId($this->post_id);

            return $comments;
        }
        catch (Exception $error) {
            throw new Exception("Algo deu errado: {$error->getMessage()}");
        }
    }

    private function validateData() {
        
    }
}