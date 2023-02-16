<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('logo');
            $table->string('shop_name');
            $table->text('address');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('email_1');
            $table->string('email_2')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('vimeo')->nullable();
            $table->decimal('vat', 8, 2)->nullable();
            $table->decimal('shipping_charge', 8, 2)->nullable();
            $table->text('banner_1')->nullable();
            $table->text('banner_2')->nullable();
            $table->text('banner_3')->nullable();
            $table->text('banner_4')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
