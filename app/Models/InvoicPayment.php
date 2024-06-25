<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class InvoicePayment extends Model
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
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
