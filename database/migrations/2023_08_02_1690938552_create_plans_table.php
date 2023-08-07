<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {

		$table->id();
		$table->string('name', 191);
		$table->decimal('price', 16, 8)->default(0);
		$table->integer('bv')->default(null);
		$table->decimal('ref_com', 16, 8)->default(null);
		$table->decimal('tree_com', 16, 8)->default(null);
		$table->integer('daily_ad_limit')->default(0);
		$table->tinyInteger('status')->default(1);
		$table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('plans');
    }
};