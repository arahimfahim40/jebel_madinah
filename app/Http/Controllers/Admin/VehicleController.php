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
        'auction_name',
        'buyer_number',
        'note'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 20;
        $status = in_array($request->status, Vehicle::VEHICLE_STATUS) ? $request->status : '';

        $vehicles = Vehicle::when(!empty($status), function ($q) use ($status) {
            $q->where('status', $status);
        })
            ->when(!empty($request->owner_id), function ($q) use ($request) {
                $q->where('owner_id', $request->owner_id);
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
    public function cost_analysis(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 20;
        $status = in_array($request->status, Vehicle::VEHICLE_STATUS) ? $request->status : '';


        $vehicles = Vehicle::with('owner:id,name')
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
            return view('admin.vehicles.cost_analysis_data', compact('vehicles', 'status', 'paginate'));
        }
        return view('admin.vehicles.cost_analysis', compact('vehicles', 'status', 'paginate'));
    }

    public function summary(Request $request)
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

        if ($request->vehicleStatus == '4categories') {
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

    private function vehicleValidationRules()
    {
        return [
            'owner_id' => 'required|exists:owners,id',
            'vin' => 'required|string|max:255|unique:vehicles',
            'lot_number' => 'required|numeric:max:12|unique:vehicles',
            'auction_name' => 'nullable|in:IAAI,Copart',
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
                'owner_id',
                'year',
                'make',
                'model',
                'color',
                'vin',
                'lot_number',
                'container_number',
                'auction_name',
                'note',
                'buyer_number',
                'vehicle_price',
                'towing_cost',
                'clearance_cost',
                'ship_cost',
                'storage_cost',
                'custom_cost',
                'tds_cost',
                'other_cost',
                'sold_price',
                'invoice_description'
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
                'owner_id',
                'year',
                'make',
                'model',
                'color',
                'vin',
                'lot_number',
                'container_number',
                'auction_name',
                'note',
                'buyer_number',
                'vehicle_price',
                'towing_cost',
                'clearance_cost',
                'ship_cost',
                'storage_cost',
                'custom_cost',
                'tds_cost',
                'other_cost',
                'sold_price',
                'invoice_description'
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
        try {
            // Find the vehicle
            $vehicle = Vehicle::findOrFail($id);
            if ($vehicle->status == 'sold') {
                return response()->json(['status' => 'error', 'message' => 'Cannot delete a sold vehicle!']);
            }
            $vehicle->update(['deleted_by' => auth()->id()]);
            // Delete the vehicle
            $vehicle->delete();
            return response()->json(['status' => 'success', 'message' => 'Vehicle deleted successfully!']);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong, cannot delete the user.' . $ex->getMessage()]);
        }
    }

    public function change_status(Request  $request)
    {
        try {
            DB::beginTransaction();
            if (empty($request->selectedVehicleIds)) {
                throw new \InvalidArgumentException('No vehicle IDs were specified to change the status.');
            }
            Vehicle::whereIn('id', $request->selectedVehicleIds)
                ->update(['status' => $request->status]);
            DB::commit();
            return response()->json(['result' => true, 'message' => 'Vehicles status changed successfully!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['result' => false, 'message' => 'Something went wrong, ' . $th->getMessage()], 400);
        }
    }


    public function trash_list(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 20;

        // dd($request->searchValue);
        $vehicles = Vehicle::onlyTrashed()
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
            return view('admin.vehicles.trash_data', compact('vehicles', 'paginate'));
        }
        return view('admin.vehicles.trash_list', compact('vehicles', 'paginate'));
    }

    public function restore(string $id)
    {
        try {
            // Find the vehicle
            $vehicle = Vehicle::withTrashed()->findOrFail($id);

            // Restore the vehicle
            $vehicle->restore();

            // Update the 'deleted_by' field
            $vehicle->update(['deleted_by' => null]);
            return response()->json(['status' => 'success', 'message' => 'Vehicle restored successfully!']);
        } catch (\Exception $ex) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong, cannot delete the user.' . $ex->getMessage()]);
        }
    }
}