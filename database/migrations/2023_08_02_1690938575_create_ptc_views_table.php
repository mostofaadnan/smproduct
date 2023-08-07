<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ptc_views', function (Blueprint $table) {
            $table->id();
            $table->integer('ptc_id')->default(null);
            $table->integer('user_id')->default(null);
            $table->string('vdt', 40)->default(null);
            $table->decimal('amount', 18, 8)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ptc_views');
    }
};
