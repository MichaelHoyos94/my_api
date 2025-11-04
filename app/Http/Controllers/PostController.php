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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
