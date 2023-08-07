<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('email_sms_templates', function (Blueprint $table) {

		$table->id();
		$table->string('act', 191);
		$table->string('name', 191);
		$table->string('subj', 191);
		$table->text('email_body')->default(null);
		$table->text('sms_body')->default(null);
		$table->text('shortcodes');
		$table->tinyInteger('email_status')->default(1);
		$table->tinyInteger('sms_status')->default(1);
		$table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('email_sms_templates');
    }
};