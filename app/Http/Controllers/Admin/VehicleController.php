<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $status = in_array($request->status, Vehicle::VEHICLE_STATUS) ? $request->status : '';
        $searchColumns = [
            'vin',
            'lot_number',
            'year',
            'make',
            'model',
            'color',
            'container_number',
            'title_number',
            'auction',
            'auction_city',
            'hat_number',
            'buyer_number',
            'licence_number',
            'customer_remark',
            'note'
        ];
        $vehicles = Vehicle::with('location:id,name')
        ->when(!empty($status), function ($q) use ($status) {
            $q->where('status', $status);
        })
        ->when(!empty($request->searchValue), function ($q) use ($request, $searchColumns) {
            foreach ($searchColumns as $value) {
                $q->orWhere($value, 'LIKE', "%$request->searchValue%");
            }
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

    private function vehicleValidationRules (){
        return [
            'customer_id' => 'required|exists:customers,id',
            'point_of_loading_id' => 'required|exists:locations,id',
            'vin' => 'required|string|max:255|unique:vehicles',
            'lot_number' => 'required|numeric:max:12|unique:vehicles',
            'ship_as' => 'nullable|in:half-cut,complete',
            'is_key' => 'nullable|in:Yes,No',
            'photos_link' => 'nullable|url',
            'auction_invoice_link' => 'nullable|url',
            'vehicle_price' => 'nullable|numeric',
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationRules = $this->vehicleValidationRules();
        // Validate the input data
        $validator = Validator::make($request->all(), $validationRules);

        // If validation fails, redirect back with error and old input
        if ($validator->fails()) {
            $allInputs = array_merge($request->all(), ['customer_name' => $request->customer_id ? Customer::where('id', $request->customer_id)->pluck('name')->first() : null]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($allInputs);
        }

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
            $allInputs = array_merge($request->all(), ['customer_name' => $request->customer_id ? Customer::where('id', $request->customer_id)->pluck('name')->first() : null]);
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput($allInputs);
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
        $vehicle = Vehicle::find($id);
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validationRules = $this->vehicleValidationRules();
        $validationRules['vin'] = 'required|string|max:255|unique:vehicles,vin,' . $id;
        $validationRules['lot_number'] = 'required|string|max:255|unique:vehicles,lot_number,' . $id;
        
        // Validate the input data
        $validator = Validator::make($request->all(), $validationRules);

        // If validation fails, redirect back with error and old input
        if ($validator->fails()) {
            $allInputs = array_merge($request->all(), ['customer_name' => $request->customer_id ? Customer::where('id', $request->customer_id)->pluck('name')->first() : null]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($allInputs);
        }

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
            $vehicle = Vehicle::find($id);
            $vehicle = $vehicle->update($filteredData);

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            return redirect()->route('vehicles.index')->with('success', 'Vehicle Updated successfully');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();
            $allInputs = array_merge($request->all(), ['customer_name' => $request->customer_id ? Customer::where('id', $request->customer_id)->pluck('name')->first() : null]);
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput($allInputs);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}