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
        return view('customer.dashboard');
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
            // ->where('customer_id', '=', auth()->id())
            ->first()->toArray();

        } else if ($request->type == 'Invoice') {
            $result = Invoice::select(
                DB::raw("SUM(CASE WHEN status = 'open' THEN 1 ELSE 0 END) AS t_open_invoice"),
                DB::raw("SUM(CASE WHEN status = 'past_due' THEN 1 ELSE 0 END) AS t_past_due_invoice"),
                DB::raw("SUM(CASE WHEN status = 'paid' THEN 1 ELSE 0 END) AS t_paid_invoice")
            )
            // ->where('customer_id', '=', auth()->id())
            ->first()->toArray();
        }

        return response()->json($result);
    }

}