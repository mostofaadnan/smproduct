<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('deposits', function (Blueprint $table) {
			$table->id();
			$table->integer('user_id');
			$table->integer('method_code');
			$table->decimal('amount', 18, 8);
			$table->string('method_currency', 191);
			$table->decimal('charge', 18, 8);
			$table->decimal('rate', 18, 8);
			$table->decimal('final_amo', 18, 8)->default(0);
			$table->text('detail')->default(null);
			$table->string('btc_amo', 191)->default(null);
			$table->string('btc_wallet', 191)->default(null);
			$table->string('trx', 191)->default(null);
			$table->integer('try')->default(0);
			$table->tinyInteger('status')->comment('1=>success, 2=>pending, 3=>cancel')->default(0);
			$table->string('admin_feedback', 250)->default(null);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('deposits');
	}
};
