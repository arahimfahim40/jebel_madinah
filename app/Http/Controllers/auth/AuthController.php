<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    public function admin_profile(Request $request){
        $user = Auth::user();
        return view('auth.admin_profile',compact('user'));
    }

    public function change_password(Request $request){
        
        $this->validate($request, [
            'email' => 'required|email',
            'old_password' => 'required',
            'new_password' => 'required',
        ]);
        
        $user = Auth::user();
        if(Auth::guard('user')->attempt(['email'=>$user->email, 'password'=>$request->old_password,'status'=>'Active'])) {
            try{
                User::where('id',$user->id)->update(["password"=>bcrypt($request['new_password'])]);
                return redirect()->back()->with('success', 'Password updated successfully!');
            }
            catch(Exception $e){
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
        return redirect()->back()->with("error","Your Old Password is Incorrect."); 

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
