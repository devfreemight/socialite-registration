<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedSmallInteger('gender')->nullable()->default(null);
            $table->date('birthdate')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('age_range')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('address')->nullable();
            $table->string('landmark')->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('password')->nullable();
            $table->dateTime('password_updated_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
