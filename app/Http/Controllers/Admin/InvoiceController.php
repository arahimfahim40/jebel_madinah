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
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:open,pending,past_due,paid',
            'exchange_rate' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'invoice_date' => 'required|date',
            'move_to_open_date' => 'required|date',
            'invoice_due_date' => 'required|date',
            'vehicles' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();

            // Retrieve the filtered data from the request
            $filteredData = $request->only([
                'customer_id',
                'exchange_rate',
                'move_to_open_date',
                'invoice_date',
                'invoice_due_date',
                'status',
                'discount',
                'description',
            ]);

            $filteredData['created_by'] = $user->id;
            $invoice = Invoice::create($filteredData);

            $vehicles = explode(',', $request->vehicles);
            foreach ($vehicles as $vehicleId) {
                $vehicle = Vehicle::findOrFail($vehicleId);
                $vehicle->invoice()->associate($invoice);
                $vehicle->save();
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::find($id);
        $customers = Customer::get();
        $vehicles = [];
        
        if ($invoice->vehicles()->exists()) {
            $vehicles = $invoice->vehicles()
                ->select(DB::raw('CONCAT(vin, \' | \', lot_number) as text'), 'id')
                ->pluck('text', 'id')
                ->toArray();
        }

        return view('admin.invoices.edit', compact('invoice', 'customers', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:open,pending,past_due,paid',
            'exchange_rate' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'invoice_date' => 'required|date',
            'move_to_open_date' => 'required|date',
            'invoice_due_date' => 'required|date',
            'vehicles' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            $user = Auth::user();

            $filteredData = $request->only([
                'customer_id',
                'exchange_rate',
                'move_to_open_date',
                'invoice_date',
                'invoice_due_date',
                'status',
                'discount',
                'description',
            ]);

            $filteredData['updated_by'] = $user->id;

            $invoice = Invoice::findOrFail($id);
            $invoice->update($filteredData);

            Vehicle::where('invoice_id', $invoice->id)->update(['invoice_id' => null]);

            $vehicles = explode(',', $request->vehicles);
            foreach ($vehicles as $vehicleId) {
                $vehicle = Vehicle::findOrFail($vehicleId);
                $vehicle->invoice()->associate($invoice);
                $vehicle->save();
            }

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
        $user = Auth::user();
        try{
            Invoice::where('id',$id)->update(['deleted_by' => $user->id]);
            Invoice::find($id)->delete();
            return redirect()->route('invoices.index')->with('success', 'Deleted successfully!');
        } catch(\Exception $ex) {
            return redirect()->route('invoices.show', ['id' => $id])->with('error', 'Something went wrong, cannot delete the user.');
        }
    }

    public function get_vehicles_open_of_customer(Request $request)
{
    try {
        // Validate request ID
        if (!$request->has('id')) {
            return response()->json(['error' => 'Customer ID is required.'], 400);
        }

        // Retrieve the customer by ID
        $customer = Customer::findOrFail($request->id);

        // Fetch customer vehicles with specified fields
        $customerVehicles = $customer->vehicles()->select([
            'id',
            'auction_fee_charge',
            'storage_charge',
            'towing_charge',
            'dismantal_charge',
            'shiping_charge',
            'custom_charge',
            'demurage_charge',
            'other_charge',
            'lot_number',
            'vin'
        ])->get();

        // Return the vehicles as JSON
        return response()->json($customerVehicles);
    } catch (\Exception $e) {
        // Log the error message for debugging
        Log::error('Failed to retrieve customer vehicles.', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(), // Add stack trace for more detailed debugging
        ]);

        // Return error response
        return response()->json(['error' => 'Failed to retrieve customer vehicles.'], 500);
    }
}

    public function invoice_pdf(Request $request, $id)
    {
        try {
            
            $invoice = Invoice::with('payments')->find($id);
            $payments =  $invoice->payments;
            // dd($invoice);
            $pdf = PDF::loadView('admin.invoices.invoice_pdf', compact('invoice', 'payments'), ['format' => ['A4', 190, 236]]); 
            $file_name = Str::slug($invoice->customer->name  . '_' . sprintf("ALSMS%'.04d\n", @$id));
            return $pdf->download($file_name . '.pdf');
        } catch (\Throwable $th) {
            dd($th->getMessage());
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
