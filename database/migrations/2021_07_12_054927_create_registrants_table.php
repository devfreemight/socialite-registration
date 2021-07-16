<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedSmallInteger('gender')->nullable()->default(null);
            $table->date('birthday')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('age')->nullable();
            $table->string('street')->nullable();
            $table->string('barangay_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('landmark')->nullable();
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
        Schema::dropIfExists('registrants');
    }
}
