<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    private static $searchColumns = [
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
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $status = in_array($request->status, Vehicle::VEHICLE_STATUS) ? $request->status : '';
        
        $vehicles = Vehicle::with('location:id,name')
        ->when(!empty($status), function ($q) use ($status) {
            $q->where('status', $status);
        })
        ->when(!empty($request->location_id), function ($q) use ($request) {
            $q->where('point_of_loading_id', $request->location_id);
        })
        ->when(!empty($request->customer_id), function ($q) use ($request) {
            $q->where('customer_id', $request->customer_id);
        })
        ->when(!empty($request->searchValue), function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                foreach (self::$searchColumns as $value) {
                    $query->orWhere($value, 'LIKE', "%$request->searchValue%");
                }
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate($paginate);
        
        if ($request->ajax()) {
          return view('admin.vehicles.data', compact('vehicles', 'status', 'paginate'));
        }
        return view('admin.vehicles.list', compact('vehicles', 'status', 'paginate'));
    }
    /**
     * Display a listing of the resource.
     */
    public function cost_analysis (Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $status = in_array($request->status, Vehicle::VEHICLE_STATUS) ? $request->status : '';

        
        $vehicles = Vehicle::with('location:id,name')
        ->when(!empty($status), function ($q) use ($status) {
            $q->where('status', $status);
        })
        ->when(!empty($request->searchValue), function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                foreach (self::$searchColumns as $value) {
                    $query->orWhere($value, 'LIKE', "%$request->searchValue%");
                }
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate($paginate);
        
        if ($request->ajax()) {
          return view('admin.vehicles.data', compact('vehicles', 'status', 'paginate'));
        }
        return view('admin.vehicles.list', compact('vehicles', 'status', 'paginate'));
    }

    public function summary (Request $request)
    {
        $vehicleSummary = Customer::leftJoin('vehicles', 'vehicles.customer_id', '=', 'customers.id')
        ->select(
            'customer_id',
            'customers.name as customer_name',
            DB::raw("SUM(CASE WHEN vehicles.status = 'pending' THEN 1 ELSE 0 END) AS pending"),
            DB::raw("SUM(CASE WHEN vehicles.status = 'on_the_way' THEN 1 ELSE 0 END) AS on_the_way"),
            DB::raw("SUM(CASE WHEN vehicles.status = 'on_hand_no_title' THEN 1 ELSE 0 END) AS on_hand_no_title"),
            DB::raw("SUM(CASE WHEN vehicles.status = 'on_hand_with_title' THEN 1 ELSE 0 END) AS on_hand_with_title"),
            DB::raw("SUM(CASE WHEN vehicles.status = 'shipped' THEN 1 ELSE 0 END) AS shipped"),
        )
        ->when(!empty($request->searchValue), function ($q) use ($request) {
            $q->where('customers.name', 'LIKE', "%$request->searchValue%");
        })
        ->when(!empty($request->location_id), function ($q) use ($request) {
            $q->where('point_of_loading_id', $request->location_id);
        })
        ->groupBy('customer_id')
        ->when(!empty($request->vehicleStatus) && $request->vehicleStatus != '4categories', function ($q) use ($request) {
            $q->having($request->vehicleStatus, '>', 0);
        })
        ->get();

        if($request->vehicleStatus == '4categories'){
            $vehicleSummary = $vehicleSummary->filter(function ($item) {
                return $item->pending > 0 || $item->on_the_way > 0 || $item->on_hand_no_title > 0 || $item->on_hand_with_title > 0;
            });
        }
        
        if ($request->ajax()) {
          return view('admin.vehicles.summary_data', compact('vehicleSummary'));
        }
        return view('admin.vehicles.summary', compact('vehicleSummary'));
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
        $this->validate($request, $validationRules);
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
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput($request->all());
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
        $this->validate($request, $validationRules);

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
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput($request->all());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function change_status(Request  $request){
        try {
            DB::beginTransaction();
            if(empty($request->selectedVehicleIds)){
                throw new \InvalidArgumentException('No vehicle IDs were specified to change the status.');
            }
            Vehicle::whereIn('id', $request->selectedVehicleIds)
            ->update(['status' => $request->status]);
            DB::commit();
            return response()->json(['result' => true, 'message' =>'Vehicles status changed successfully!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['result' => false, 'message' =>'Something went wrong, '. $th->getMessage() ], 400);

        }
    }
}