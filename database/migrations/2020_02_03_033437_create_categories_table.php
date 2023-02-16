<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->text('slug');
            $table->integer('parent_id')->default(0);
            $table->text('thumbnail')->nullable();
            $table->boolean('status')->default(1)->comment('1 (active), 0 (not active)');
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
        Schema::dropIfExists('categories');
    }
}
