<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number');
            $table->unsignedInteger('user_id');
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_region')->nullable();
            $table->decimal('sub_total', 10, 2);
            $table->integer('vat')->nullable();
            $table->decimal('total', 10, 2);
            $table->decimal('shipping_charge', 10, 2);
            $table->string('payment_method')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 (pending), 1 (processing), 2 (delivered), 3 (cancel)');
            $table->boolean('is_delete')->default(0)->comment('0 (not delete), 1 (delete)');
            $table->dateTime('processing_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
