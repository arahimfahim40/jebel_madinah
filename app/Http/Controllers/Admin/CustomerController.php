<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $customers = Customer::with(['createdBy:name','updatedBy:name'])->orderBy('id', 'desc')->paginate($paginate);

        if ($request->ajax()) {
          return view('admin.customers.data', compact('customers',  'paginate'));
        }
        return view('admin.customers.list', compact('customers',  'paginate'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|string|in:Male,Female',
            'status' => 'required|string|in:Active,Inactive',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string',
            'phone' => 'required|string',
            'join_date' => 'nullable|date',
            'second_email' => 'nullable|email|unique:customers',
            'second_phone' => 'nullable|string',           
            'about' => 'nullable|string',            
           
            //'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024',
            
        ]);

        dd($request->all());
        try {
            //$customer = Customer::create($request->all());
            $customer = Customer::create([
                "name" => $request['name'],
                "address" => $request['address'],
                "gender" => $request['gender'],
                "status" => $request['status'],
                "email" => $request['email'],
                "password" => bcrypt($request['password']),
                'phone'=> $request['phone'],
                'join_date' => $request['join_date'],
                'second_email' => $request['second_email'],
                'second_phone' => $request['second_phone'],
                'about' => $request['about'],
            ]);
           
            return redirect()->route('customer.show', ['id' => $customer->id])->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->route('customer.index')->with('error', 'Something went wrong, cannot save the user.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::with(['createdBy:name','updatedBy:name'])->find($id);
        return view('admin.customers.view',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $search)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function s2s_customers(Request $request)
    {
        $search = $request->search;
    
        $response = Customer::where('name', 'like', "%{$search}%")
          ->orderBy('id', 'desc')
          ->select('id', 'name as text')
          ->limit(20)
          ->get();
    
        return response()->json($response);

    }
}