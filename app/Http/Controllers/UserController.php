<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('profile')->get();
        return response()->json([
            'success' => true,
            'message' => 'List User',
            'data' => $users
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
        $user = User::create([
            'name' => $request->name,
            'email' =>$request->email,
            'password' => Hash::make($request->password)
        ]);
        if($user){
            return response()->json([
                'success' => true,
                'message' => 'User Created',
                'data' => $user
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'User Failed to Save',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::with('profile')->get()->where('id', $user->id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Detail User',
            'data' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);
        if($user){
            $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email,
                'password' => Hash::make($request->password) ?? $user->password
            ]);
            return response()->json([
                'success' => true,
                'message' => 'User Updated',
                'data' => $user
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'User Not Found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        if($user){
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User Deleted',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'User Not Found',
            ], 404);
        }
    }
}
