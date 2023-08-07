<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_extras', function (Blueprint $table) {
		$table->id();
		$table->integer('user_id');
		$table->integer('paid_left')->default(0);
		$table->integer('paid_right')->default(0);
		$table->integer('free_left')->default(0);
		$table->integer('free_right')->default(0);
		$table->decimal('bv_left', 16, 8)->default(0);
		$table->decimal('bv_right', 16, 8)->default(0);
		$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_extras');
    }
};