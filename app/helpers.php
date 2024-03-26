<?php

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Location;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Cache;

if (!function_exists("getLocations")) {
    function getLocations() {
        return Cache::remember('locations', 86400, function () {
            return Location::select('id', 'name')->get();
        });
    }
}

if (!function_exists("getDashboardCounts")) {
    function getDashboardCounts() {
        return Cache::remember('dashboard_counts', 600 , function () {
            return [ 
                'vehicles' => Vehicle::count(),
                'invoices' => Invoice::count(),
                'customers' => Customer::count(),
                'users' => User::count(),
            ] ;
        });
    }
}