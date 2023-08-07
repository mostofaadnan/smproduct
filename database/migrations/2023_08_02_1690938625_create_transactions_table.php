<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

			$table->id();
            $table->integer('user_id')->default(null);
            $table->decimal('amount', 18, 8)->default(0);
            $table->decimal('charge', 18, 8)->default(0);
            $table->decimal('post_balance', 18, 8)->default(0);
            $table->string('trx_type', 10)->default(null);
            $table->string('trx', 25)->default(null);
            $table->string('details', 255)->default(null);
            $table->string('remark', 50)->default(null);
			$table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};