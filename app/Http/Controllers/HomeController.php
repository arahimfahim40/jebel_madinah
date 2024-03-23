<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function admin_sidebar_count(Request $request){
        return response()->json([
            't_all_vehicle' => Vehicle::count(),
            't_all_invoice' => Invoice::count()
        ]);
    }

    
    public function admin_sidebar_sub_count(Request $request){
        if ($request->type == 'Vehicle') {
            $result = Vehicle::select(
                DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS t_pending"),
                DB::raw("SUM(CASE WHEN status = 'on_the_way' THEN 1 ELSE 0 END) AS t_on_the_way"),
                DB::raw("SUM(CASE WHEN status = 'on_hand_no_title' THEN 1 ELSE 0 END) AS t_on_hand_no_title"),
                DB::raw("SUM(CASE WHEN status = 'on_hand_with_title' THEN 1 ELSE 0 END) AS t_on_hand_with_title"),
                DB::raw("SUM(CASE WHEN status = 'shipped' THEN 1 ELSE 0 END) AS t_shipped"),
            )->first()->toArray();

        } else if ($request->type == 'Invoice') {
            $result = Invoice::select(
                DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS t_pending_invoice"),
                DB::raw("SUM(CASE WHEN status = 'open' THEN 1 ELSE 0 END) AS t_open_invoice"),
                DB::raw("SUM(CASE WHEN status = 'past_due' THEN 1 ELSE 0 END) AS t_past_due_invoice"),
                DB::raw("SUM(CASE WHEN status = 'paid' THEN 1 ELSE 0 END) AS t_paid_invoice")
            )->first()->toArray();
        }

        return response()->json($result);
    }
}