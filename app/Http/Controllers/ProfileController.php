<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::all();
        return response()->json([
            'success' => true,
            'message' => 'List Profile',
            'data' => $profiles
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
        $profile = Profile::create([
            'username' => $request->username,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'country' => $request->country,
            'user_id' => $request->user_id
        ]);
        if($profile){
            return response()->json([
                'success' => true,
                'message' => 'Profile Created',
                'data' => $profile
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Profile Failed to Save',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        $profile = Profile::with('user')->where('id', $profile->id)->first();
        if($profile){
            return response()->json([
                'success' => true,
                'message' => 'Detail Profile',
                'data' => $profile
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Profile Not Found',
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $profile = Profile::findOrFail($profile->id);
        if($profile){
            $profile->update([
                'username' => $request->username ?? $profile->username,
                'gender' => $request->gender ?? $profile->gender,
                'phone' => $request->phone ?? $profile->phone,
                'country' => $request->country ?? $profile->country,
                'user_id' => $request->user_id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Profile Updated',
                'data' => $profile
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile Not Found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile = Profile::findOrFail($profile->id);
        if($profile){
            $profile->delete();
            return response()->json([
                'success' => true,
                'message' => 'Profile Deleted',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Profile Not Found',
            ], 404);
        }
    }
}
