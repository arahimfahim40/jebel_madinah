<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TimeZone extends Model
{
    protected $table = 'time_zones';
    protected $fillable = [
        "name",
    ];

    protected $guarded = ['id'];
    public function user()
    {
        return $this->hasMany(User::class, 'time_zone_id', 'id');
        
    }
}