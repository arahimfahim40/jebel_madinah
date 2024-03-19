<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        })
        ->orderBy('created_at', 'desc')
        ->paginate($paginate);
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
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'point_of_loading_id' => 'required|exists:locations,id',
            'vin' => 'required|string|max:255',
            'lot_number' => 'required|numeric',
            'ship_as' => 'nullable|in:half-cut,complete',
            'is_key' => 'nullable|in:Yes,No',
            'photos_link' => 'nullable|url',
            'auction_invoice_link' => 'nullable|url',
            'vehicle_price' => 'nullable|numeric',
        ]);

        try {
            DB::beginTransaction();

            // Retrieve the filtered data from the request
            $filteredData = $request->only([
                'customer_id',
                'year',
                'make',
                'model',
                'color',
                'vin',
                'lot_number',
                'container_number',
                'point_of_loading_id',
                'ship_as',
                'purchase_date',
                'payment_date',
                'pickup_date',
                'delivery_date',
                'note',
                'customer_remark',
                'hat_number',
                'title_received_date',
                'title_number',
                'title_status',
                'weight',
                'buyer_number',
                'auction',
                'auction_city',
                'is_key',
                'licence_number',
                'photos_link',
                'auction_invoice_link',
                'vehicle_price',
                'towing_charge',
                'auction_fee_charge',
                'dismantal_charge',
                'shiping_charge',
                'storage_charge',
                'custom_charge',
                'demurage_charge',
                'other_charge',
                'towing_cost',
                'auction_fee_cost',
                'dismantal_cost',
                'ship_cost',
                'storage_cost',
                'custom_cost',
                'demurage_cost',
                'other_cost'
            ]);

            // Create a new vehicle store
            $vehicle = Vehicle::create($filteredData);

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();

            // Handle the exception or return an error response
            return response()->json(['message' => 'Failed to create vehicle store', 'error' => $e->getMessage()], 500);
        }

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