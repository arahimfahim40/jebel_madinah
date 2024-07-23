<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvoicePayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoicePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = InvoicePayment::all();
        return view('invoice_payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoice_payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'payment_amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'evidence_link' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();

            $payment = InvoicePayment::create([
                'invoice_id' => $request->invoice_id,
                'payment_amount' => $request->payment_amount,
                'payment_date' => $request->payment_date,
                'evidence_link' => $request->evidence_link,
                'description' => $request->description,
                'created_by' => $user->id,
            ]);

            DB::commit();
            return response()->json(['message' => 'Payment created successfully', 'status' => 'success'], 200);
            // return redirect()->route('invoice_payments.index')->with('success', 'Payment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Failed to create payment', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('invoice_payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('invoice_payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'payment_times' => 'nullable|integer',
            'payment_amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'evidence_link' => 'nullable|string',
            'description' => 'nullable|string',
            'discount' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();
            $payment = InvoicePayment::findOrFail($id);

            $payment->update($request->all());
            $payment->updated_by = Auth::id();
            $payment->save();

            DB::commit();
            return response()->json(['message' => 'Payment created successfully', 'status' => 'success'], 200);
            // return redirect()->route('invoice_payments.index')->with('success', 'Payment updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Failed to update payment', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $payment = InvoicePayment::findOrFail($id);

            $payment->deleted_by = Auth::id();
            $payment->save();
            $payment->delete();

            DB::commit();
            return response()->json(['message' => 'Payment deleted successfully', 'status' => 'success'], 200);
            // return redirect()->route('invoice_payments.index')->with('success', 'Payment deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Failed to delete payment', 'error' => $e->getMessage()], 500);
        }
    }
}