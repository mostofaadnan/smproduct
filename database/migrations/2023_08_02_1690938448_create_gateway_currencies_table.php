<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('gateway_currencies', function (Blueprint $table) {

			$table->id();
			$table->string('name', 191)->default(null);
			$table->string('currency', 191);
			$table->string('symbol', 191);
			$table->integer('method_code')->default(null);
			$table->string('gateway_alias', 25)->default(null);
			$table->decimal('min_amount', 18, 8);
			$table->decimal('max_amount', 18, 8);
			$table->decimal('percent_charge', 5, 2)->default(0);
			$table->decimal('fixed_charge', 18, 8)->default(0);
			$table->decimal('rate', 18, 8)->default(0);
			$table->string('image', 191)->default(null);
			$table->text('gateway_parameter')->default(null);
			$table->timestamps();
			
		});
	}

	public function down()
	{
		Schema::dropIfExists('gateway_currencies');
	}
};
