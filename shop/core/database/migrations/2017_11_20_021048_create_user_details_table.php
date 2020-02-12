<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('s_name')->nullable();
            $table->string('s_email')->nullable();
            $table->string('s_number')->nullable();
            $table->string('s_company')->nullable();
            $table->string('s_country')->nullable();
            $table->string('s_state')->nullable();
            $table->string('s_city')->nullable();
            $table->string('s_zip')->nullable();
            $table->string('s_address')->nullable();
            $table->string('s_landmark')->nullable();
            $table->string('b_name')->nullable();
            $table->string('b_email')->nullable();
            $table->string('b_number')->nullable();
            $table->string('b_company')->nullable();
            $table->string('b_country')->nullable();
            $table->string('b_state')->nullable();
            $table->string('b_city')->nullable();
            $table->string('b_zip')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
