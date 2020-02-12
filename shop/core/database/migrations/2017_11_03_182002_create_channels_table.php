<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('channel_type');
            $table->tinyInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('logo');
            $table->string('image');
            $table->binary('code');
            $table->binary('description');
            $table->text('tags');
            $table->boolean('featured')->default(0);
            $table->integer('view')->default(0);
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
        Schema::dropIfExists('channels');
    }
}
