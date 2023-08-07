<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('support_tickets', function (Blueprint $table) {
		
			$table->id();
			$table->integer('user_id')->default(null);
			$table->string('name', 191)->default(null);
			$table->string('email', 91)->default(null);
			$table->string('ticket', 191)->default(null);
			$table->string('subject', 191)->default(null);
			$table->tinyInteger('status')->comment('0: Open, 1: Answered, 2: Replied, 3: Closed');
			$table->dateTime('last_reply')->default(null);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('support_tickets');
	}
};
