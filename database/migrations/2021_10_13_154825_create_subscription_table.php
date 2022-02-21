<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription', function (Blueprint $table) {
            $table->bigIncrements('subscription_id');
            $table->bigIncrements('users_id');
            $table->string('paypal_sub_id');
            $table->string('paypal_order_id');
            $table->enum('plan_subs', array('annual', 'monthly'));
            $table->enum('status', array('cancelled', 'paused', 'active'));
            $table->timestamp('date_started')->nullable(false);
            $table->date('date_ended')->nullable(false);
            $table->enum('auto_renew', array('on', 'off'));
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
        Schema::dropIfExists('subscription');
    }
}
