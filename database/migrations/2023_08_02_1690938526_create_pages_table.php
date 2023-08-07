<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            
        $table->id();
        $table->string('name', 191)->default(null);
        $table->string('slug', 191)->default(null);
        $table->string('tempname', 191)->comment('template name')->default(null);
        $table->text('secs')->default(null);
        $table->integer('is_default')->default(0);
        $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};