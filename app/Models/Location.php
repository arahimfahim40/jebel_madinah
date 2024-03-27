<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Location extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;
    //protected $connection = 'mysql';
    protected $table = 'locations';

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
    protected static $logName = 'Location';

    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
        // Chain fluent methods for configuration options
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'point_of_loading_id', 'id');
    }
}
