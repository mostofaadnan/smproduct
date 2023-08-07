<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
		$table->id();
		$table->integer('code')->default(null);
		$table->string('alias', 191)->default(NULL);
		$table->string('image', 191)->default(null);
		$table->string('name', 191);
		$table->tinyInteger('status')->default(1);
		$table->text('parameters')->default(null);
		$table->text('supported_currencies')->default(null);
		$table->tinyInteger('crypto')->comment('0: fiat currency, 1: crypto currency')->default(0);
		$table->text('extra')->default(null);
		$table->text('description')->default(null);
		$table->text('input_form')->default(null);
		$table->timestamps();
		
        });
    }

    public function down()
    {
        Schema::dropIfExists('gateways');
    }
};