<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('logo');
            $table->mediumText('description');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('face_link')->nullable();
            $table->string('tw_link')->nullable();
            $table->boolean('display')->default(1);
            $table->boolean('active')->default(1);
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('companies');
    }
}
