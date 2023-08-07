<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ptcs', function (Blueprint $table) {

		$table->id();
		$table->integer('ads_type')->comment('1 = link | 2 = image | 3 = script')->default(null);
		$table->string('title', 191)->default(null);
		$table->text('ads_body')->nullable()->default(null);
		$table->decimal('amount', 18, 8)->default(0);
		$table->integer('duration')->default(0);
		$table->integer('max_show')->default(0);
		$table->integer('showed')->default(0);
		$table->integer('remain')->default(0);
		$table->tinyInteger('status')->default(1);
		$table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('ptcs');
    }
};