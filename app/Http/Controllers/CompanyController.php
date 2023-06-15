<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::with('services')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Company',
            'data' => $companies
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
        $company = Company::create([
            'name' => $request->name,
            'email' =>$request->email
        ]);
        if($company){
            return response()->json([
                'success' => true,
                'message' => 'Company Created',
                'data' => $company
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Company Failed to Save',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company = Company::find($company->id)->with('services')->first();
        return response()->json([
            'success' => true,
            'message' => 'Detail Company',
            'data' => $company
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $company = Company::findOrFail($company->id);
        if($company){
            $company->update([
                'name' => $request->name,
                'email' =>$request->email
            ]);    
            return response()->json([
                'success' => true,
                'message' => 'Company Updated',
                'data' => $company
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Company Failed to Update',
            ], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company = Company::findOrFail($company->id);
        if($company){
            $company->delete();
            return response()->json([
                'success' => true,
                'message' => 'Company Deleted',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Company Failed to Delete',
            ], 409);
        }
    }

    public function attach(Request $request)
    {
        $company = Company::findOrFail($request->company_id);
        $company->services()->attach($request->service_id);
        return response()->json([
            'success' => true,
            'message' => 'Service Attached',
            'data' => $company
        ], 200);

    }

    public function detach(Request $request)
    {
        $company = Company::findOrFail($request->company_id);
        $company->services()->detach($request->service_id);
        return response()->json([
            'success' => true,
            'message' => 'Service Detached',
            'data' => $company
        ], 200);

    }
}