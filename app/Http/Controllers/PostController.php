<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('comments')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Post',
            'data' => $posts
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' =>$request->content
        ]);
        if($post){
            return response()->json([
                'success' => true,
                'message' => 'Post Created',
                'data' => $post
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Failed to Save',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post = Post::with('comments')->where('id', $post->id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Detail Post',
            'data' => $post
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $post = Post::findOrFail($post->id);
        if($post){
            $post->update([
                'title' => $request->title,
                'content' =>$request->content
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Post Updated',
                'data' => $post
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Not Found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post = Post::findOrFail($post->id);
        if($post){
            $post->delete();
            return response()->json([
                'success' => true,
                'message' => 'Post Deleted',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Not Found',
            ], 404);
        }
    }
}
