<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryRegister extends Model
{
    //

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'time_in',
        'time_out',
        'delivery_time',
        'hours_worked',
        'extra_note',
        'closed_status',
        'product_temprature',
        'take_off_time',
        'vehicle_temprature',
        'delivery_temprature',
        'delivery_route_id',
    ];



    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function delivery_route()
    {
        return $this->belongsTo(DeliveryRoute::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
