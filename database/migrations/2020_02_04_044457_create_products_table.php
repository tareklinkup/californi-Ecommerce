<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('category_id');
            $table->string('name', 255);
            $table->text('slug');
            $table->text('thumbnail')->nullable();
            $table->string('product_code', 50)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('discount_percent')->nullable();
            $table->decimal('discount_amount')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1)->comment('1 (active), 0 (not active)');
            // $table->boolean('is_featured')->default(0)->comment('1 (featured), 0 (not featured)');
            $table->boolean('is_deleted')->default(0)->comment('1 (delete), 0 (not delete)');
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
