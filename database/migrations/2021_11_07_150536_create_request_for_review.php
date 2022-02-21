<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestForReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_for_review', function (Blueprint $table) {

            $table->bigIncrements('review_id');
            $table->integer('agent_id');
            $table->string('details_of_result')->nullable();
            $table->enum('status', array('pending', 'completed', 'rejected', 'deactivated')); 
            $table->integer('review_by')->nullable();
            $table->datetime('date_review_completed')->nullable();
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
        Schema::dropIfExists('request_for_review');
    }
}
