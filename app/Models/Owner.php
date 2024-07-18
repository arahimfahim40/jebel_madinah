<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
//use Spatie\Activitylog\Traits\LogsActivity;

class Owner extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'owners';

    protected $fillable = [
        "name",
        "created_by",
        "updated_by",
        "deleted_by",
    ];

    protected $guarded = ['id'];
    protected static $logAttributes = ['*'];
    protected static $logAttributesToIgnore = ['created_at', 'updated_at'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Owner';


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'owner_id', 'id');
    }
}
