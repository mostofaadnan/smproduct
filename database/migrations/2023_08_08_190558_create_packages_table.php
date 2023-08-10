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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('purchase_type');
            $table->string('package_code');
            $table->string('name')->nullable();
            $table->integer('bv')->default(0);
            $table->unsignedBigInteger('generation_id')->nullable();
            $table->unsignedBigInteger('repurchase_generation_id')->nullable();
            $table->boolean('re_purchase_able');
            $table->decimal('total_cost_price', 8, 2)->nullable()->default(0);
            $table->decimal('total_sale_price', 8, 2)->nullable()->default(0);
            $table->string('image')->nullable();
            $table->text('short_description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
