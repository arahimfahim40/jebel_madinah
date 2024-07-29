<?php

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Owner;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Cache;

if (!function_exists("getOwners")) {
    function getOwners()
    {
        return Cache::remember('owners', 100, function () {
            return Owner::select('id', 'name')->get();
        });
    }
}

if (!function_exists("getDashboardCounts")) {
    function getDashboardCounts()
    {
        return Cache::remember('dashboard_counts', 100, function () {
            return [
                'vehicles' => Vehicle::count(),
                'invoices' => Invoice::count(),
                'customers' => Customer::count(),
                'users' => User::count(),
            ];
        });
    }
}