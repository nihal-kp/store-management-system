<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_prefix')->default(+91);
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->comment('0: Disabled, 1: Enabled');
            $table->tinyInteger('verification_status');
            $table->integer('verification_otp')->nullable();
            $table->tinyInteger('otp_verification_status')->default(0);
            $table->string('password');
            $table->tinyInteger('reg_type')->default(0)->comment('0: email reg, 1: OTP reg, 2: Profile completed ');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
