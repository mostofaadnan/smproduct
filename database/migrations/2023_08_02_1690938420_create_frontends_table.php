<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('frontends', function (Blueprint $table) {

		$table->id();
		$table->string('data_keys',40);
		$table->text('data_values')->nullable()->default('NULL');
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('frontends');
    }
};