<?php

namespace App\services;

use App\Models\Post;
use App\repositories\PostRepository;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private PostRepository $postRepository) {}

    public function getAll() {
        return $this->postRepository->getAll();
    }

    public function findById($id) {
        return $this->postRepository->findById($id);
    }

    public function create(array $data) {
        return $this->postRepository->create($data);
    }

    public function updateById($id, array $data) {
        return $this->postRepository->updateById($id, $data);
    }

    public function deleteById($id) {
        return $this->postRepository->deleteById($id);
    }
}
