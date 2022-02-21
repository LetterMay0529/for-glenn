<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('property_id');
            $table->bigIncrements('users_id');
            $table->string('title');
            $table->longText('description');
            $table->float('amount');
            $table->string('prop_img');
            $table->enum('property_status', array('remove', 'sold', 'availables'));
            $table->enum('property_type', array('commercial', 'land', 'residence'));
            $table->string('property_size');
            $table->string('location');
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
        Schema::dropIfExists('property');
    }
}
