<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicle;
use PDF;
use Str;

class InvoiceController extends Controller
{

    private static $searchColumns = [
        'id',
        'description',
        'vehicles.vin',
        'vehicles.lot_number',
        'customer.name'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 20;
        $status = in_array($request->status, Invoice::INVOICE_STATUS) ? $request->status : '';

        $invoices = Invoice::with('customer:id,name', 'vehicles', 'payments')
            ->when(!empty($status), function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->when(!empty($request->searchValue), function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    foreach (self::$searchColumns as $value) {
                        $fields = explode('.', $value);
                        $searchQuery = $request->searchValue;
                        if (count($fields) == 1) {
                            if ($value == 'id') {
                                $search = preg_replace('/[^0-9.]+/', '', $searchQuery);
                                $query->where($value, '=', $search);
                            } else {
                                $query->orWhere($value, 'LIKE', "%$searchQuery%");
                            }
                        } elseif (count($fields) == 2) {
                            $query->orWhereHas($fields[0], function ($q2) use ($fields, $searchQuery) {
                                $q2->where($fields[1], 'LIKE', "%$searchQuery%");
                            });
                        }
                    }
                });
            })
            ->orderBy('id', 'desc')
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
        $vehicles = Vehicle::whereIn('status', ['on_the_way', 'inventory'])
            ->whereNull('invoice_id')
            ->select('id', 'vin', 'lot_number', 'sold_price', 'year', 'make', 'model', 'color')
            ->get();

        return view('admin.invoices.create', compact('vehicles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'discount' => 'nullable|numeric',
            'vehicles' => 'required|array',
        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();
            // Retrieve the filtered data from the request
            $filteredData = $request->only([
                'customer_id',
                'invoice_date',
                'invoice_due_date',
                'discount',
                'description',
            ]);
            $filteredData['status'] = 'pending';

            $filteredData['created_by'] = $user->id;
            $invoice = Invoice::create($filteredData);

            foreach ($request->vehicles as $id => $soldPrice) {
                Vehicle::where('id', $id)->update([
                    'sold_price' => $soldPrice,
                    'invoice_id' => $invoice->id,
                    'status' => 'sold'
                ]);
            }

            DB::commit();

            // Redirect back with success message
            return redirect()->route('invoices.index')->with('success', 'Invoice created successfully');
        } catch (\Exception $e) {
            // An error occurred, rollback the transaction
            DB::rollBack();

            // Handle the exception or return an error response
            return response()->json(['message' => 'Failed to create invoice store', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            $invoice = Invoice::with('payments', 'vehicles', 'customer')->find($id);

            return view('admin.invoices.view', compact('invoice'));
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = 'error';
            $response['message'] = 'Error, Please Try again! ' . $e->getMessage();
            return response()->json($response, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::with('vehicles')->find($id);
        $customers = Customer::get();
        $vehicles = Vehicle::whereIn('status', ['on_the_way', 'inventory'])
            ->whereNull('invoice_id')
            ->select('id', 'vin', 'lot_number', 'sold_price', 'year', 'make', 'model', 'color')
            ->get();

        return view('admin.invoices.edit', compact('invoice', 'customers', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'discount' => 'nullable|numeric',
            'invoice_date' => 'required|date',
            'vehicles' => 'required|array',
        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();

            $filteredData = $request->only([
                'customer_id',
                'invoice_date',
                'invoice_due_date',
                'discount',
                'description',
            ]);

            $filteredData['updated_by'] = $user->id;

            $invoice = Invoice::findOrFail($id);
            $invoice->update($filteredData);

            foreach ($request->vehicles as $vehicleId => $soldPrice) {
                Vehicle::where('id', $vehicleId)
                    ->update(['sold_price' => $soldPrice, 'invoice_id' => $invoice->id, 'status' => 'sold']);
            }

            // Unlink vehicles not included in the request
            $invoice->vehicles()
                ->whereNotIn('id', array_keys($request->vehicles))
                ->update([
                    'invoice_id' => null,
                    'sold_price' => null,
                    'status' => 'inventory'
                ]);

            DB::commit();

            return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update invoice', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the invoice
            $invoice = Invoice::findOrFail($id);

            // Unlink the vehicles
            $invoice->vehicles()->update([
                'invoice_id' => null,
                'sold_price' => null,
                'status' => 'inventory'
            ]);

            $invoice->update(['deleted_by' => auth()->id()]);
            // Delete the invoice
            $invoice->delete();
            return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully!');
        } catch (\Exception $ex) {
            return redirect()->route('invoices.show', ['id' => $id])->with('error', 'Something went wrong, cannot delete the user.');
        }
    }


    public function invoice_pdf(Request $request, $id)
    {
        try {

            $invoice = Invoice::with('payments', 'vehicles', 'customer')->find($id);
            $pdf = PDF::loadView('admin.invoices.invoice_pdf', compact('invoice'), ['format' => ['A4', 190, 236]]);
            $file_name = Str::slug($invoice->customer->name  . '_' . sprintf("JAM%'.06d\n", @$id));
            return $pdf->download($file_name . '.pdf');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function view_single_invoice(Request $request)
    {
        try {
            $invoiceId = $request->invoice_id;
            $invoice = Invoice::with('payments')->find($invoiceId);

            if (!$invoice) {
                return response()->json(['status' => 'error', 'message' => 'Invoice not found'], 404);
            }

            return view('admin.invoices.invoice_pdf', ['invoice' => $invoice, 'payments' => $invoice->payments]);
        } catch (\Exception $e) {
            DB::rollBack();
            $response['status'] = 'error';
            $response['message'] = 'Error, Please Try again! ' . $e->getMessage();
            return response()->json($response, 500);
        }
    }
}
