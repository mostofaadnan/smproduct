<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {

			$table->id();
            $table->integer('method_id');
            $table->integer('user_id');
            $table->decimal('amount', 18, 8);
            $table->string('currency', 40);
            $table->decimal('rate', 18, 8);
            $table->decimal('charge', 18, 8);
            $table->string('trx', 40);
            $table->decimal('final_amount', 18, 8)->default(0);
            $table->decimal('after_charge', 18, 8);
            $table->text('withdraw_information')->default(null);
            $table->tinyInteger('status')->comment('1=>success, 2=>pending, 3=>cancel,')->default(0);
            $table->text('admin_feedback')->default(null);
			$table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
};