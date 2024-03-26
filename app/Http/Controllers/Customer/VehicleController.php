<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

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
    ];
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $status = in_array($request->status, Vehicle::VEHICLE_STATUS) ? $request->status : '';
        
        $vehicles = Vehicle::with('location:id,name')
        ->where('status', '!=', 'pending')
        ->where('customer_id', '=', auth()->id())
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
          return view('customer.vehicles.data', compact('vehicles', 'status', 'paginate'));
        }
        return view('customer.vehicles.list', compact('vehicles', 'status', 'paginate'));
    }


}