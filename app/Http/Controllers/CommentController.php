<?php

namespace App\Http\Controllers;

use App\services\CommentService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use ApiResponse;
    public function __construct(private CommentService $commentService) { }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $post_id)
    {
        $user_id = $request->user();
        $validated = $request->validate([
            'comment' => 'string|required'
        ]);
        $validated['post_id'] = $post_id;
        $validated['user_id'] = $user_id;
        $comment = $this->commentService->create($validated);
        return $this->success($comment, 'comment created', 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'comment' => 'string|required'
        ]);
        $data = $this->commentService->update($id, $validated);
        return $this->success($data, 'comment updated', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->commentService->delete($id);
        return $this->success([], 'comment deleted', 200);
    }
}
