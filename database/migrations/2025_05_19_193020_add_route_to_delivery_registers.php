<?php

use App\Models\DeliveryRoute;
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
            $table->foreignIdFor(DeliveryRoute::class)->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_registers', function (Blueprint $table) {
            //
            $table->dropForeignIdFor(DeliveryRoute::class);
        });
    }
};
