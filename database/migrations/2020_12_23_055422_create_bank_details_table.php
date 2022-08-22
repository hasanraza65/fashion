<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('account_no');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('ifsc_code');
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
        Schema::dropIfExists('bank_details');
    }
}
