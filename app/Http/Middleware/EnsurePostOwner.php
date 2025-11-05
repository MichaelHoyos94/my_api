<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePostOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $post_id = $request->route('id');
        $post = Post::findOrFail($post_id);
        if (!$post) return response()->json(['message' => 'post not found'], 404);
        if ($post->user_id !== $user->id) return response()->json(['message' => 'Forbidden: you cant modify this post'], 403);
        return $next($request);
    }
}
