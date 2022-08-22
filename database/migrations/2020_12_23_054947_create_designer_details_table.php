<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designer_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title_tag')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('designer_details');
    }
}
