<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\services\PostService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    use ApiResponse;

    public function __construct(private PostService $postService) { }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $posts = $this->postService->getAll();
        return $this->success($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        $validated = $request->validate([
            'text' => 'required|string',
            'photo' => 'nullable|string'
        ]);
        $validated['user_id'] = $user_id;
        $post = $this->postService->create($validated);
        return $this->success($validated, 'post created', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->findById($id);
        return $this->success($post, 'post info', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'text' => 'string|required',
            'photo' => 'nullable|sring'
        ]);
        $postUpdated = $this->postService->updateById($id, $validated);
        return $this->success($postUpdated, 'post updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postDeletedId = $this->postService->deleteById($id);
        return $this->success([], `Post id: {$postDeletedId} deleted`, 200);
    }
}
