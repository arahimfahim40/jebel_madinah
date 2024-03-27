<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class InvoicPayment extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    //protected $connection = 'mysql';
    protected $table = 'vehicles';


    protected $fillable = [
        'invoice_id',
        'payment_times',
        'payment_amount',
        'payment_date',
        'evidence_link',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $guarded = ['id'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'invoice_payment';


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
