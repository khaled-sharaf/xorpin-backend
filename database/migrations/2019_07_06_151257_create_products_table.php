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
            $table->string('name');
            $table->string('photo');
            $table->text('gallery')->nullable();
            $table->integer('price');
            $table->string('discount', 20)->nullable();
            $table->integer('old_price')->nullable();
            $table->integer('new_price')->nullable();
            $table->mediumText('description');
            $table->string('manufacture_company');
            $table->integer('product_count');
            $table->boolean('execute')->default(0);
            $table->boolean('display')->default(1);
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('company_id');
            $table->softDeletes();
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
