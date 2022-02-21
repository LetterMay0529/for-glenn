<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddInvNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_inv_notes', function (Blueprint $table) {
            $table->bigIncrements('notes_id');
            $table->bigInteger('inv_id');  
            $table->bigInteger('reviewed_by'); 
            $table->longtext('notes_details');
            $table->enum('status', array('pending', 'new', 'completed', 'closed')); 
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
        Schema::dropIfExists('add_inv_notes');
    }
}
