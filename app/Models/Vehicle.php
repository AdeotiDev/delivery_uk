<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //

    // $table->string('name');
    // $table->string('plate_number');
    // $table->string('type')->default('Van');
    // $table->foreignId('driver_id')->constrained('users');
    // $table->string('status')->default('Active');

    protected $fillable = [
        'name',
        'plate_number',
        'type',
        'driver_id',
        'status',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
    
}
