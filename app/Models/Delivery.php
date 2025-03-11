<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{

    protected $fillable = [
        'tracking_number',
        'vehicle_id',
        'driver_id',
        'sender_name',
        'sender_phone',
        'pickup_address',
        'dropoff_address',
        'status',
    ];

}
