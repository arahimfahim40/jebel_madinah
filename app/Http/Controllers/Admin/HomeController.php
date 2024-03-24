<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth');
    } */
    
    public function index(Request $request)
    {
        return view('admin.dashboard');
    }
}