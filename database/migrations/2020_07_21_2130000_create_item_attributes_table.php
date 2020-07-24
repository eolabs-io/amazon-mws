<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateItemAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('binding')->nullable();
            $table->string('brand')->nullable();
            $table->boolean('is_adult_product')->nullable();
            $table->string('label')->nullable();
            $table->string('manufacturer')->nullable();
            $table->integer('package_quantity')->nullable();
            $table->string('part_number')->nullable();
            $table->string('product_group')->nullable();
            $table->string('product_type_name')->nullable();
            $table->string('publisher')->nullable();
            $table->string('size')->nullable();
            $table->string('studio')->nullable();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('item_dimension_id')->nullable();
            $table->unsignedBigInteger('package_dimension_id')->nullable();
            $table->unsignedBigInteger('small_image_id')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('item_dimension_id')->references('id')->on('item_dimensions');
            $table->foreign('package_dimension_id')->references('id')->on('package_dimensions');
            $table->foreign('small_image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_attributes');
    }
}
