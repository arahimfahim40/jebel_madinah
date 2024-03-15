<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Invoice extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    //protected $connection = 'mysql';
    protected $table = 'invoices';

    protected $fillable = [
        "customer_id",
        "exchange_rate",
        "move_to_open_date",
        "invoice_date",
        "invoice_due_date",
        "status",
        "discount",
        "description",
        "created_by",
        "updated_by",
        "deleted_by",
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

    public function vehicles()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
