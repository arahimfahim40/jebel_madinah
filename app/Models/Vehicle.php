<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
// use Spatie\Activitylog\Traits\LogsActivity;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;
    //protected $connection = 'mysql';
    protected $table = 'vehicles';

    const VEHICLE_STATUS = ['on_the_way', 'inventory', 'sold'];

    protected $fillable = [
        'owner_id',
        'year',
        'make',
        'model',
        'color',
        'vin',
        'lot_number',
        'container_number',
        'auction_name',
        'note',
        'buyer_number',
        'vehicle_price',
        'towing_cost',
        'clearance_cost',
        'ship_cost',
        'storage_cost',
        'custom_cost',
        'tds_cost',
        'other_cost',
        'sold_price',
        'invoice_description',

        "created_by",
        "updated_by"
    ];

    protected $guarded = ['id'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'pgl';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
        // Chain fluent methods for configuration options
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
}