<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::With('companies')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Service',
            'data' => $services
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
        $service = Service::create([
            'name' => $request->name,
            'description' =>$request->description
        ]);
        if($service){
            return response()->json([
                'success' => true,
                'message' => 'Service Created',
                'data' => $service
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Service Failed to Save',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service = Service::With('companies')->where('id', $service->id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Detail Service',
            'data' => $service
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $service = Service::findOrFail($service->id);
        if($service){
            $service->update([
                'name' => $request->name,
                'description' =>$request->description
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Service Updated',
                'data' => $service
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Service Not Found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service = Service::findOrFail($service->id);
        if($service){
            $service->delete();
            return response()->json([
                'success' => true,
                'message' => 'Service Deleted',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Service Not Found',
            ], 404);
        }
    }
}
