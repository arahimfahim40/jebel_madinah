<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $status = in_array($request->status, Vehicle::VEHICLE_STATUS) ? $request->status : '';
        // dd($request->status);
        $vehicles = Vehicle::with('location:id,name')
        ->when(!empty($status), function ($q) use ($status) {
            $q->where('status', $status);
        })->paginate($paginate);
        if ($request->ajax()) {
          return view('admin.vehicles.data', compact('vehicles', 'status', 'paginate'));
        }
        
        return view('admin.vehicles.list', compact('vehicles', 'status', 'paginate'));
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
    public function destroy(string $id)
    {
        //
    }
}
