<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $customers = Customer::with(['createdBy','updatedBy'])->orderBy('id', 'desc')->paginate($paginate);

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

        $user = Auth::user();
        try {
            $customer = new Customer;
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->gender = $request->gender;
            $customer->status = $request->status;
            $customer->email = $request->email;
            $customer->password = bcrypt($request->password);
            $customer->phone = $request->phone;
            $customer->join_date = $request->join_date;
            $customer->second_email = $request->second_email;
            $customer->second_phone = $request->second_phone;
            $customer->about = $request->about;
            $customer->created_by = $user->id;
            $customer->updated_by = $user->id;
            $customer->save();
           
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
        $customer = Customer::with(['createdBy','updatedBy'])->find($id);
        return view('admin.customers.view',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::with(['createdBy','updatedBy'])->find($id);
        return view('admin.customers.update',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|string|in:Male,Female',
            'status' => 'required|string|in:Active,Inactive',
            'email' => 'required|email|unique:customers,email,'.$id,
            'password' => 'nullable|string',
            'phone' => 'required|string',
            'join_date' => 'nullable|date',
            'second_email' => 'nullable|email|unique:customers,second_email,'.$id,
            'second_phone' => 'nullable|string',           
            'about' => 'nullable|string',            
            //'photo' => 'mimes:jpg,png,jpeg,bmp,gif|max:1024',
        ]);
        $user = Auth::user();
        try {
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->address = $request->address;
            $customer->gender = $request->gender;
            $customer->status = $request->status;
            $customer->email = $request->email;
            if($request->password){
            $customer->password = bcrypt($request->password);
            }
            $customer->phone = $request->phone;
            $customer->join_date = $request->join_date;
            $customer->second_email = $request->second_email;
            $customer->second_phone = $request->second_phone;
            $customer->about = $request->about;
            $customer->updated_by = $user->id;
            $customer->save();
            return redirect()->route('customer.show', ['id' => $id])->with('success', 'Saved successfully!');
        } catch (Exception $ex) {
            return redirect()->route('customer.show', ['id' => $id])->with('error', 'Something went wrong, cannot save the user.');
        }
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