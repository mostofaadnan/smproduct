<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('support_messages', function (Blueprint $table) {

		$table->id();
		$table->string('supportticket_id',191);
		$table->integer('admin_id')->default(0);
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('support_messages');
    }
};