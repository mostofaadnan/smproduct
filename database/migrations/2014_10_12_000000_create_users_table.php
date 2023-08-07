<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('ref_id')->default(0);
            $table->integer('pos_id')->default(0);
            $table->integer('position')->default(0);
            $table->integer('plan_id')->default(0);
            $table->integer('dpl')->comment('daily_ad_limit')->default(0);
            $table->string('firstname', 50)->default(null);
            $table->string('lastname', 50)->default(null);
            $table->string('username', 50);
            $table->string('email', 90);
            $table->string('mobile', 50)->default(null);
            $table->decimal('balance', 18, 8)->default(0);
            $table->decimal('total_ref_com', 18, 8)->default(0);
            $table->decimal('total_binary_com', 18, 8)->default(0);
            $table->decimal('total_invest', 18, 8)->default(0);
            $table->string('password', 255);
            $table->string('image', 91)->nullable()->default(null);
            $table->text('address')->comment('contains full address')->default(null);
            $table->tinyInteger('status')->comment('0: banned, 1: active')->default(1);
            $table->tinyInteger('ev')->comment('0: email unverified, 1: email verified')->default(0);
            $table->tinyInteger('sv')->comment('0: sms unverified, 1: sms verified')->default(0);
            $table->string('ver_code', 91)->nullable()->comment('stores verification code')->default(null);
            $table->dateTime('ver_code_send_at')->nullable()->comment('verification send time')->default(null);
            $table->tinyInteger('ts')->nullable()->comment('0: 2fa off, 1: 2fa on')->default(0);
            $table->tinyInteger('tv')->nullable()->comment('0: 2fa unverified, 1: 2fa verified')->default(1);
            $table->string('tsc', 255)->nullable()->default(null);
            $table->string('provider', 255)->nullable()->default(null);
            $table->string('provider_id', 255)->nullable()->default(null);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
