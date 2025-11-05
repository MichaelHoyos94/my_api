<?php

namespace App\services;

use App\repositories\CommentRepository;

class CommentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private CommentRepository $commentRepository) {}

    public function create(array $data) {
        return $this->commentRepository->create($data);
    }

    public function update($id, array $data) {
        return $this->commentRepository->update($id, $data);
    }

    public function delete($id) {
        return $this->commentRepository->deleteById($id);
    }
}
