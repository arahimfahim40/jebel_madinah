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
        "point_of_loading_id",
        "vin",
        "lot_number",
        "year",
        "make",
        "color",
        "model",
        "container_number",
        "title_number",
        "title_state",
        "title_received_date",
        "auction",
        "auction_city",
        "purchase_date",
        "pickup_date",
        "deliver_date",
        "payment_date",
        "hat_number",
        "buyer_number",
        "licence_number",
        "weight",
        "cbm",
        "photos_link",
        "auction_invoice_link",
        "customer_remark",
        "note",
        "status",
        "ship_as",
        "is_key",
        "vehicle_price",
        "auction_fee_charge",
        "storage_charge",
        "towing_charge",
        "dismantal_charge",
        "ship_charge",
        "custom_charge",
        "demurage_charge",
        "other_charge",
        
        "auction_fee_cost",
        "storage_cost",
        "towing_cost",
        "dismantal_cost",
        "ship_cost",
        "custom_cost",
        "demurage_cost",
        "other_cost",

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
    
    public function location()
    {
        return $this->belongsTo(Location::class, 'point_of_loading_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}