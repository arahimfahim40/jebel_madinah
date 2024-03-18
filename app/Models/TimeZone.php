<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Location extends Model
{
    //protected $connection = 'mysql';
    protected $table = 'time_zones';

    protected $fillable = [
        "name",
    ];

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class, 'time_zone_id', 'id');
    }
}