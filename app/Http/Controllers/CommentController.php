<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('post')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Comment',
            'data' => $comments
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
        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id
        ]);

        if($comment){
            return response()->json([
                'success' => true,
                'message' => 'Comment Created',
                'data' => $comment
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Comment Failed to Save',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        $comment = Comment::with('post')->where('id', $comment->id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Detail Comment',
            'data' => $comment
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);
        if($comment){
            $comment->update([
                'comment' => $request->comment,
                'post_id' => $request->post_id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Comment Updated',
                'data' => $comment
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Comment Not Found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);
        if($comment){
            $comment->delete();
            return response()->json([
                'success' => true,
                'message' => 'Comment Deleted',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Comment Not Found',
            ], 404);
        }
    }
}
