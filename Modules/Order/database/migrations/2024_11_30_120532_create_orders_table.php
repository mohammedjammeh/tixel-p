<?php

use \App\Enums\OrderStatus;
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
        $statuses = collect(OrderStatus::cases())->pluck('value')->toArray();

        Schema::create('orders', function (Blueprint $table) use ($statuses) {
            $table->id();
            $table->enum('status', $statuses)->default(OrderStatus::NEW->value)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
