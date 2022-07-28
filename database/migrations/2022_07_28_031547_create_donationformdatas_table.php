<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donationformdatas', function (Blueprint $table) {
            $table->id();
            $table->string('donationType');
            $table->string('donationAmount');
            $table->string('fullname');
            $table->string('title')->nullable();
            $table->string('mobileAreacode');
            $table->string('mobile');
            $table->string('email');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('address3')->nullable();
            $table->string('area')->nullable();
            $table->string('district')->nullable();
            $table->string('remark')->nullable();
            $table->boolean('receipt');
            $table->boolean('interested');
            $table->string('paymentMethod');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donationformdatas');
    }
};
