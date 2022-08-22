<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturer_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('percentage')->nullable();
            $table->string('adhar_no')->nullable();
            $table->string('adhar_pic')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
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
        Schema::dropIfExists('manufacturer_details');
    }
}
