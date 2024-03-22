<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $status = in_array($request->status, Invoice::INVOICE_STATUS) ? $request->status : '';

        $invoices = Invoice::with('customer:id,name')
        ->when(!empty($status), function ($q) use ($status) {
            $q->where('status', $status);
        })
        ->orderBy('created_at', 'desc')
        ->paginate($paginate);
        if ($request->ajax()) {
          return view('admin.invoices.data', compact('invoices', 'status', 'paginate'));
        }
        
        return view('admin.invoices.list', compact('invoices', 'status', 'paginate'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
