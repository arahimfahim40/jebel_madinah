<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
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
        if(Auth::attempt($credentials)) 
        {
            $request->session()->regenerate();
            return redirect()->intended(route('home.index'));
        }
        return redirect()->back()->withErrors("Your Email or Password is Incorrect."); 
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
