<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use PDF;

class CustomerReportController extends Controller
{
    public function list(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 20;
        $customerReport = Invoice::leftJoin('invoice_payments as ip', function ($query) {
            $query->on('ip.invoice_id', '=', 'invoices.id')
                ->whereNull('ip.deleted_at');
        })
            ->leftJoin('customers as cus', function ($q) {
                $q->on('invoices.customer_id', '=', 'cus.id')
                    ->whereNull('cus.deleted_at');
            })
            ->leftJoin('vehicles as v', function ($q) {
                $q->on('invoices.id', '=', 'v.invoice_id')
                    ->whereNull('v.deleted_at');
            })
            ->when(!empty($request->from_date), function ($q) use ($request) {
                $q->whereDate('invoices.invoice_date', '>=', $request->from_date);
            })
            ->when(!empty($request->to_date), function ($q) use ($request) {
                $q->whereDate('invoices.invoice_date', '<=', $request->to_date);
            })
            ->when(!empty($request->status), function ($q) use ($request) {
                $q->where('invoices.status', $request->status);
            })
            ->select(
                'cus.id',
                'cus.name as customer_name',
                DB::raw("IFNULL(SUM(v.sold_price), 0) AS total_invoice"),
                DB::raw("IFNULL(SUM(ip.payment_amount), 0) AS total_paid"),
                DB::raw("IFNULL(SUM(invoices.discount), 0) AS total_discount"),
                DB::raw("IFNULL(SUM(v.sold_price), 0) - IFNULL(SUM(ip.payment_amount), 0) - IFNULL(SUM(invoices.discount), 0) AS total_due_balance"),
                DB::raw("IFNULL(COUNT(v.id), 0) AS total_vehicles"),
            )
            ->groupBy('cus.id')
            ->paginate($paginate);
        return view('admin.reports.customer.list', [
            'customerReport' => $customerReport
        ]);
    }

    public function view(Request $request, $customer_id)
    {
        $invoices = Invoice::with('customer', 'vehicles', 'payments')
            ->whereIn('invoices.status', ['open', 'past_due'])
            ->where('invoices.customer_id', $customer_id)
            ->get();
        $customer = Customer::find($customer_id);
        return view('admin.reports.customer.view', [
            'invoices' => $invoices,
            'customer' => $customer
        ]);
    }



    public function pdf(Request $request, $customer_id)
    {
        $invoices = Invoice::with('customer', 'vehicles', 'payments')
            ->whereIn('invoices.status', ['open', 'past_due'])
            ->where('invoices.customer_id', $customer_id)
            ->get();
        $customer = Customer::find($customer_id);


        $pdf = PDF::loadView('admin.reports.customer.pdf', [
            'invoices' => $invoices,
            'customer' => $customer
        ], [
            'format' => ['A4', 190, 236]
        ]);
        // $pdf->setOptions(['isPhpEnabled' => true]);
        $pdf->setPaper("A4", "landscape");
        return $pdf->download(str_replace(' ', '_', @$customer->name) . '.pdf');
    }
}