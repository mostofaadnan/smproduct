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
        Schema::create('sponsore_commission_plandetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->integer('generation');
            $table->decimal('commission',8,2)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsore_commission_plandetails');
    }
};
