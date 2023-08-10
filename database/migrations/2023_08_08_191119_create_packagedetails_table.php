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
        Schema::create('packagedetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->decimal('cost_price', 8, 2)->nullable()->default(0);
            $table->decimal('sale_price', 8, 2)->nullable()->default(0);
            $table->decimal('discount_price', 8, 2)->nullable()->default(0);
            $table->decimal('qty', 8, 2)->nullable()->default(0);
            $table->decimal('total_cost_price', 8, 2)->nullable()->default(0);
            $table->decimal('total_sale_price', 8, 2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packagedetails');
    }
};
