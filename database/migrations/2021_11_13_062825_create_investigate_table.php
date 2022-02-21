<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestigateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investigate', function (Blueprint $table) {
            $table->bigIncrements('inv_id');
            $table->bigInteger('customer_id');  
            $table->bigInteger('property_id');
            $table->longtext('details');
            $table->enum('status', array('new', 'pending', 'completed'));  
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
        Schema::dropIfExists('investigate');
    }
}
