<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_logins', function (Blueprint $table) {
			$table->id();
            $table->integer('user_id');
            $table->string('user_ip', 50)->default(null);
            $table->string('location', 91)->default(null);
            $table->string('browser', 50)->default(null);
            $table->string('os', 50)->default(null);
            $table->string('longitude', 25)->default(null);
            $table->string('latitude', 25)->default(null);
            $table->string('country', 30)->default(null);
            $table->string('country_code', 15)->default(null);
			$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_logins');
    }
};