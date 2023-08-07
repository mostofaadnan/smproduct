<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('extensions', function (Blueprint $table) {

		$table->id();
		$table->string('act', 191);
		$table->string('name', 191);
		$table->text('description')->default(null);
		$table->string('image', 191)->default(null);
		$table->text('script')->default(null);
		$table->text('shortcode')->comment('object')->default(null);
		$table->text('support')->comment('help section')->default(null);
		$table->tinyInteger('status')->default(1);
		$table->dateTime('deleted_at')->default(null);
		$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('extensions');
    }
};