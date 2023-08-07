<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('support_attachments', function (Blueprint $table) {
		$table->id();
		$table->integer('support_message_id');
		$table->string('attachment');
        $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('support_attachments');
    }
};