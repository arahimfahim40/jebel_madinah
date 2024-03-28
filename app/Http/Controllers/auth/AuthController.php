<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        if (Auth::guard('user')->check()) {
            return redirect()->intended(route('user.home.index'));
        }
        else if(Auth::guard('customer')->check())
        {
            return redirect()->intended(route('customer.home.index'));
        } else{
        return view('auth.login');
        }
    }
    public function login(Request $request)
    {
        $validation = Validator::make($request->All(), [
            'email' => 'required|email',
            'password' => 'required|string']);
        if ($validation->fails()) {
            return back()->withErrors($validation);
        } 
        $credentials = $request->only('email','password');
        if(Auth::guard('user')->attempt( array_merge($credentials,['status'=>'Active']))) 
        {
            $request->session()->regenerate();
            return redirect()->intended(route('user.home.index'));
        }
        else if(Auth::guard('customer')->attempt(array_merge($credentials,['status'=>'Active'])))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('customer.home.index'));
        }
        else{
        return redirect()->back()->withErrors("Your Email or Password is Incorrect."); 
        }
    }

    function logout_user(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    function logout_customer(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
