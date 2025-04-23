<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('delivery_registers', function (Blueprint $table) {
            //
            $table->string('product_temprature')->nullable();
            $table->string('vehicle_temprature')->nullable();
            $table->string('delivery_temprature')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_registers', function (Blueprint $table) {
            //
            $table->dropColumn('product_temprature');
            $table->dropColumn('vehicle_temprature');
            $table->dropColumn('delivery_temprature');
        });
    }
};
