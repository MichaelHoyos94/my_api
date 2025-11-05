<?php

namespace App\repositories;

use App\Models\Comment;

class CommentRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function create(array $data) {
        return Comment::create($data);
    }

    public function update($id, array $data) {
        $comment = Comment::findOrFail($id);
        return $comment->update($data);
    }

    public function deleteById($id) {
        return Comment::destroy($id);
    }
}
