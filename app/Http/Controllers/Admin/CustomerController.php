<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(Request $request, string $search)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function s2s_customers(Request $request)
    {
        $search = $request->search;
    
        $response = Customer::where('name', 'like', "%{$search}%")
          ->orderBy('id', 'desc')
          ->select('id', 'name as text')
          ->limit(20)
          ->get();
    
        return response()->json($response);

    }
}
