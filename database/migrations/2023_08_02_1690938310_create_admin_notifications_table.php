<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0);
            $table->string('title', 100)->default(null);
            $table->tinyInteger('read_status')->default(0);
            $table->text('click_url')->default(null);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_notifications');
    }
};
