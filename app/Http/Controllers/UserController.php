<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'photo' => 'nullable|string'
        ]);
        $user = $request->user();
        $user->update($validated);
        return response()->json([
            'status'=> 'Success',
            'data'=> $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $user = $request->user();
        $user->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'User deleted.'
        ]);
    }
}
