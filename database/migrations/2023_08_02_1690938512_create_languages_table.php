<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {

        $table->id();
        $table->string('name', 191);
        $table->string('code', 191);
        $table->string('icon', 191)->default(null);
        $table->tinyInteger('text_align')->comment('0: left to right text align, 1: right to left text align')->default(0);
        $table->tinyInteger('is_default')->comment('0: not default language, 1: default language')->default(0);
        $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
};