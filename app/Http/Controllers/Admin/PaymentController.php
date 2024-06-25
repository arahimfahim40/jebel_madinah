<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        return view('payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric',
            'currency' => 'required|in:usd,uae',
            'discount' => 'nullable|numeric',
            'payment_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();

            $payment = Payment::create([
                'invoice_id' => $request->invoice_id,
                'amount' => $request->amount,
                'currency' => $request->currency,
                'discount' => $request->discount,
                'payment_date' => $request->payment_date,
                'description' => $request->description,
                'created_by' => $user->id,
            ]);

            DB::commit();

            return redirect()->route('payments.index')->with('success', 'Payment created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Failed to create payment', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'amount' => 'required|numeric',
            'currency' => 'required|in:usd,uae',
            'discount' => 'nullable|numeric',
            'payment_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $payment->update($request->all());
            $payment->updated_by = Auth::id();
            $payment->save();

            DB::commit();

            return redirect()->route('payments.index')->with('success', 'Payment updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Failed to update payment', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Payment $payment)
    {
        try {
            DB::beginTransaction();

            $payment->deleted_by = Auth::id();
            $payment->save();
            $payment->delete();

            DB::commit();

            return redirect()->route('payments.index')->with('success', 'Payment deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Failed to delete payment', 'error' => $e->getMessage()], 500);
        }
    }
}
