<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('sitename', 50)->default(null);
            $table->string('cur_text', 20)->comment('currency text')->default(null);
            $table->string('cur_sym', 20)->comment('currency symbol')->default(null);
            $table->string('email_from', 255)->default(null);
            $table->text('email_template')->default(null);
            $table->string('sms_api', 255)->default(null);
            $table->string('base_color', 10)->default(null);
            $table->string('secondary_color', 10)->default(null);
            $table->text('mail_config')->comment('email configuration')->default(null);
            $table->tinyInteger('ev')->comment('email verification, 0 - dont check, 1 - check')->default(0);
            $table->tinyInteger('en')->comment('email notification, 0 - dont send, 1 - send')->default(0);
            $table->tinyInteger('sv')->comment('sms verication, 0 - dont check, 1 - check')->default(0);
            $table->tinyInteger('sn')->comment('sms notification, 0 - dont send, 1 - send')->default(0);
            $table->tinyInteger('force_ssl')->default(0);
            $table->tinyInteger('secure_password')->default(0);
            $table->tinyInteger('registration')->comment('0: Off	, 1: On')->default(0);
            $table->tinyInteger('social_login')->comment('social login')->default(0);
            $table->text('social_credential')->default(null);
            $table->string('active_template', 50)->default(null);
            $table->text('sys_version')->nullable()->default(null);
            $table->string('bv_price', 50)->default(null);
            $table->string('total_bv', 50)->default(null);
            $table->integer('max_bv')->default(null);
            $table->tinyInteger('cary_flash')->default(null);
            $table->text('notice')->default(null);
            $table->text('free_user_notice')->default(null);
            $table->string('matching_bonus_time', 50)->default(null);
            $table->string('matching_when', 50)->default(null);
            $table->dateTime('last_paid')->default(null);
            $table->dateTime('last_cron')->default(null);
            $table->decimal('bal_trans_per_charge', 18, 8)->default(0);
            $table->decimal('bal_trans_fixed_charge', 18, 8)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}
