
<?php

use App\Models\Location;
use Illuminate\Support\Facades\Cache;

if (!function_exists("getLocations")) {
    function getLocations() {
        return Cache::remember('locations', 86400, function () {
            return Location::select('id', 'name')->get();
        });
    }
}