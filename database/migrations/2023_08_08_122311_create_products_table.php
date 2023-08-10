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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->string('name');
            $table->string('sku')->nullable();
            $table->decimal('cost_price',8,2)->nullable()->default(0);
            $table->decimal('sale_price',8,2)->nullable()->default(0);
            $table->decimal('discount_price',8,2)->nullable()->default(0);
            $table->decimal('tax',8,2)->nullable()->default(0);
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->text('user_data')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
