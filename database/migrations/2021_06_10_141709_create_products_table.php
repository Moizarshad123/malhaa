<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->timestamps();
            $table->softDeletes();
            $table->string('categories')->nullable();
            $table->string('product_name')->nullable();
            $table->double('regular_price')->nullable();
            $table->double('sale_price')->nullable();
            $table->string('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('main_image')->nullable();
            $table->string('multi_image')->nullable();
            $table->string('tags')->nullable();
            $table->string('stock')->nullable();
            $table->string('sku_code')->nullable();
            $table->string('manage_stock')->nullable();
            $table->string('stock_status')->nullable();
            $table->string('status')->nullable();
            $table->string('is_featured')->nullable();
            $table->string('brand')->nullable();
            $table->string('related_products')->nullable();
            $table->dateTime('sale_price_start_date_time')->nullable();
            $table->dateTime('sale_price_end_date_time')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
    }
}
