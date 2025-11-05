<?php

namespace App\repositories;

use App\Models\Post;

class PostRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    /**
     * Get all posts
     */
    public function getAll() {
        return Post::all();
    }
    /**
     * Find one post by his id
     */
    public function findById($id) {
        return Post::findOrFail($id);
    }
    /**
     * Create a new post.
     */
    public function create(array $data) {
        return Post::create($data);
    }
    /**
     * Update a post by his id.
     */
    public function updateById($id, array $data) {
        $post = Post::findOrFail($id);
        return $post->update($data);
    }
    /**
     * Delete a post by his id.
     */
    public function deleteById($id) {
        return Post::destroy($id);
    }
}
