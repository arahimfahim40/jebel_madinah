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

    const VEHICLE_STATUS = ['pending','on_the_way','on_hand_with_title','on_hand_no_title','shipped'];

    protected $fillable = [
        "customer_id",
        "invoice_id",
        "year",
        "make",
        "model",
        "color",
        "vin",
        "lot_number",
        "container_number",
        "title_received_date",
        "title_number",
        "title_state",
        "purchase_date",
        "pickup_date",
        "deliver_date",
        "note",
       
        "weight",
        "cbm",
        "licence_number",

        "storage_amount",
        "towed_from",
        "tow_amount",

        "htnumber",
        "c_remark",
        "status",
        "vehicle_type",
        "payment_date",
        "shipas",
       
        "point_of_loading_id",
        "buyer_number",
        "photos_link",
        "storage_cost",
        "vehicle_price",
        "auction_fee",
        "tow_amounts",
        "dismantal_cost",
        "ship_cost",
        "dubai_custom_cost",
        "dubai_storage_cost",
        "dubai_demurage",
        "other_cost",
        "auction",
        "auction_city",
        "title",
        "pickup_due_date",
        "title_status",
        "is_key",
        "customer_note",
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
    
    public function location()
    {
        return $this->belongsTo(Location::class, 'point_of_loading_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
