<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    // $table->string('app_name')->nullable();
    // $table->string('app_email')->nullable();
    // $table->string('app_phone')->nullable();
    // $table->string('app_address')->nullable();
    // $table->string('app_logo')->nullable();
    // $table->string('app_favicon')->nullable();
    // $table->string('app_currency')->nullable();
    // $table->string('app_currency_symbol')->nullable();
    // $table->string('app_currency_position')->nullable();
    // $table->string('app_timezone')->nullable();

    protected $fillable = [
        'app_name',
        'app_email',
        'app_phone',
        'app_address',
        'app_logo',
        'app_favicon',
        'app_currency',
        'app_currency_symbol',
        'app_currency_position',
        'app_timezone',
    ];
}
