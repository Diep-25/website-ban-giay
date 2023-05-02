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
        Schema::create('address_available', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('specific_address');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('provinces_id');
            $table->unsignedBigInteger('districts_id');
            $table->unsignedBigInteger('wards_id');
            $table->timestamps();
            $table->softDeletes();
          
             // khoa ngoai
             $table->foreign('user_id')->references('id')->on('users');
             $table->foreign('provinces_id')->references('id')->on('provinces');
             $table->foreign('districts_id')->references('id')->on('districts');
             $table->foreign('wards_id')->references('id')->on('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_available');
    }
};
