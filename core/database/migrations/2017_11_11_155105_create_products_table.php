<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('name');
            $table->string('slug');
            $table->string('sku');
            $table->string('image');
            $table->string('current_price');
            $table->string('old_price')->nullable();
            $table->integer('stock')->default(0);
            $table->binary('description');
            $table->binary('policy');
            $table->text('tags');
            $table->boolean('featured');
            $table->boolean('status');
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
        Schema::dropIfExists('products');
    }
}
