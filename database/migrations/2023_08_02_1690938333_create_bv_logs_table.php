<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bv_logs', function (Blueprint $table) {

        $table->id();
        $table->integer('user_id')->default(null);
        $table->integer('position')->comment('1=L,2=R')->default(null);
        $table->decimal('amount', 16, 8)->default(0);
        $table->string('trx_type', 50)->default(null);
        $table->string('details', 191)->default(null);
        $table->timestamps();
        
        });
    }

    public function down()
    {
        Schema::dropIfExists('bv_logs');
    }
};