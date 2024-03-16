<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Location;
use App\Models\PglInvoice;
use App\Models\Shipment;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Pgla\Account;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login(Request $request)
    {
        $data = $request->All();
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:5'
        );
        
        $validation = Validator::make($data, $rules);
        if ($validation->fails()) {
            return back()->withErrors($validation);
        } 


        dd("that is login:", $data);
       /*  ;
        
        */

        // if ($row = DB::table('users')->where('email', $data['email'])->first()) {
        //     if(password_verify($data['password'],$row->password)){
        //         session(['access'=>$row->id,'id'=>$row->id,'username'=>$row->username,'photo'=>$row->photo]);

        //if (Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']])) {

            // $locations = Location::get();
            // $vehicles = Vehicle::count();
            // $containers = Shipment::count();
            // // $containers= count($container);
            // $invoices = PglInvoice::count();
            // $customers = Customer::count();

            // $user_id = User::where('email', '=', $request['email'])->pluck('id')->first();

            // $accounts = Account::where('user_id', '=', $user_id)->count();

            // $messages = DB::table('notifications')
            //     ->where(['admin_id' => session('id'), 'type' => 0])
            //     ->orderBy('id', 'desc')
            //     ->paginate(30);

            // return view('admin.dashboard.dashboard')->with(['locations', $locations, 'vehicles' => $vehicles, 'containers' => $containers, 'invoices' => $invoices, 'customers' => $customers, 'messages' => $messages, 'accounts' => $accounts]);
            /* return redirect()->route('dashboard_admin');
        } else {
            return redirect()->back()->withErrors("Your Email or Password is Incorrect.");
        }

        return redirect()->back()->withErrors("Your Email or Password is Incorrect."); */
    }

    function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->intended('/admin_login');
        }
        return redirect()->back();
    }
}
