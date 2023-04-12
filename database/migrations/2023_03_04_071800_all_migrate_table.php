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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // ------------------
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        //-----------------------

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });


        //----------------------------

        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
        //----------------------------

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');    
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('price');
            $table->string('description')->nullable();
            $table->string('discountpercentage')->nullable();
            $table->string('rating')->nullable();
            $table->string('stock')->nullable();
            $table->string('sold')->nullable();
            $table->string('brand')->nullable();
            $table->string('thumbnail');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();

            // khoa ngoai
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
        });
        //----------------------------

        Schema::create('colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('color');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
        });
        //----------------------------

        Schema::create('product_color', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->softDeletes();
             // khoa ngoai
             $table->foreign('color_id')->references('id')->on('colors');
             $table->foreign('product_id')->references('id')->on('products');
        });
        //----------------------------

        Schema::create('size', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('size');
            $table->timestamps();
            $table->softDeletes();
        });
        //----------------------------

        Schema::create('product_size', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->softDeletes();
             // khoa ngoai
             $table->foreign('size_id')->references('id')->on('size');
             $table->foreign('product_id')->references('id')->on('products');
        });

        //----------------------------

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role');
            $table->string('discription')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        //----------------------------

        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
             // khoa ngoai
             $table->foreign('role_id')->references('id')->on('roles');
             $table->foreign('user_id')->references('id')->on('users');
        });

        //----------------------------

        Schema::create('discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('discount');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
             // khoa ngoai
             $table->foreign('user_id')->references('id')->on('users');
        });
        //----------------------------

        Schema::create('oder_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
            $table->softDeletes();
            
        });
        //----------------------------

        Schema::create('oders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('oder_address_id');
            $table->string('payment_status');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
             // khoa ngoai
             $table->foreign('oder_address_id')->references('id')->on('oder_address');
             $table->foreign('user_id')->references('id')->on('users');
        });
        //----------------------------

        Schema::create('product_oder', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('oder_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            $table->softDeletes();
          
             // khoa ngoai
             $table->foreign('oder_id')->references('id')->on('oders');
             $table->foreign('product_id')->references('id')->on('products');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('personal_access_tokens');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('product_color');
        Schema::dropIfExists('size');
        Schema::dropIfExists('product_size');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('discounts');
        Schema::dropIfExists('oder_address');
        Schema::dropIfExists('oders');
        Schema::dropIfExists('product_oder');
    }
};
