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
    protected $fillable = [
        "customer_id",
        "invoice_id",
        "year",
        "container_number",
        "title_received_date",
        "title_number",
        "title_state",
        "purchase_date",
        "pickup_date",
        "deliver_date",
        "note",
        "color",
        "model",
        "vin",
        "weight",
        "cbm",
        "value",
        "licence_number",
        "storage_amount",
        "check_number",
        "add_charges",
        "lot_number",
        "htnumber",
        "c_remark",
        "make",
        "towed_from",
        "tow_amount",
        "status",
        "vehicle_type",
        "payment_date",
        "shipas",
        "port_of_loading_id",
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
        "sales_cost",
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
    

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
