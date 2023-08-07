<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('withdraw_methods', function (Blueprint $table) {

		$table->id();
		$table->string('name', 191)->default(null);
		$table->string('image', 191)->default(null);
		$table->decimal('min_limit', 18, 8)->default(null);
		$table->decimal('max_limit', 18, 8)->default(0);
		$table->string('delay', 191)->default(null);
		$table->decimal('fixed_charge', 18, 8)->default(null);
		$table->decimal('rate', 18, 8)->default(null);
		$table->decimal('percent_charge', 5, 2)->default(null);
		$table->string('currency', 20)->default(null);
		$table->text('user_data')->default(null);
		$table->text('description')->default(null);
		$table->tinyInteger('status')->default(1);
		$table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('withdraw_methods');
    }
};