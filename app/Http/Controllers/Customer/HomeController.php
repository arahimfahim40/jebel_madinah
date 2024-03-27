<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $dashboardCounts = [
            'vehicles' => Vehicle::where('customer_id', '=', auth()->id())->count(),
            'all_invoices' => Invoice::where('customer_id', '=', auth()->id())->count(),
            'open_invoices' => Invoice::where('status', 'open')
                ->where('customer_id', '=', auth()->id())->count(),
            'paid_invoices' => Invoice::where('status', 'paid')
                ->where('customer_id', '=', auth()->id())->count(),
        ];
        
        $vehicleSummary = Vehicle::leftJoin('locations', 'locations.id', '=', 'vehicles.point_of_loading_id')
        ->where('customer_id', '=', auth()->id())
        ->select(
            'point_of_loading_id',
            'locations.name as location_name',
            DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending"),
            DB::raw("SUM(CASE WHEN status = 'on_the_way' THEN 1 ELSE 0 END) AS on_the_way"),
            DB::raw("SUM(CASE WHEN status = 'on_hand_no_title' THEN 1 ELSE 0 END) AS on_hand_no_title"),
            DB::raw("SUM(CASE WHEN status = 'on_hand_with_title' THEN 1 ELSE 0 END) AS on_hand_with_title"),
            DB::raw("SUM(CASE WHEN status = 'shipped' THEN 1 ELSE 0 END) AS shipped"),
        )
        ->groupBy('point_of_loading_id')
        ->get();
        return view('customer.dashboard', compact('vehicleSummary', 'dashboardCounts'));
    }

    public function customer_sidebar_count(Request $request){
        return response()->json([
            't_all_vehicle' => Vehicle::where('customer_id', '=', auth()->id())->count(),
            't_all_invoice' => Invoice::where('customer_id', '=', auth()->id())->count()
        ]);
    }

    
    public function customer_sidebar_sub_count(Request $request){
        if ($request->type == 'Vehicle') {
            $result = Vehicle::select(
                DB::raw("SUM(CASE WHEN status = 'on_the_way' THEN 1 ELSE 0 END) AS t_on_the_way"),
                DB::raw("SUM(CASE WHEN status = 'on_hand_no_title' THEN 1 ELSE 0 END) AS t_on_hand_no_title"),
                DB::raw("SUM(CASE WHEN status = 'on_hand_with_title' THEN 1 ELSE 0 END) AS t_on_hand_with_title"),
                DB::raw("SUM(CASE WHEN status = 'shipped' THEN 1 ELSE 0 END) AS t_shipped"),
            )
            ->where('customer_id', '=', auth()->id())
            ->first()->toArray();

        } else if ($request->type == 'Invoice') {
            $result = Invoice::select(
                DB::raw("SUM(CASE WHEN status = 'open' THEN 1 ELSE 0 END) AS t_open_invoice"),
                DB::raw("SUM(CASE WHEN status = 'past_due' THEN 1 ELSE 0 END) AS t_past_due_invoice"),
                DB::raw("SUM(CASE WHEN status = 'paid' THEN 1 ELSE 0 END) AS t_paid_invoice")
            )
            ->where('customer_id', '=', auth()->id())
            ->first()->toArray();
        }

        return response()->json($result);
    }

}