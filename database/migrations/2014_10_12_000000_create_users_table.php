<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->index('users_id');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->enum('gender', array('Male', 'Female'));
            $table->date('date_of_birth');
            $table->boolean('rank');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('profile_img')->nullable();
            $table->string('phone')->unique();
            $table->string('status');
            $table->longText('about_me');
            $table->date('email_verified_at')->nullable();
            $table->date('phone_verified_at')->nullable();
            $table->date('date_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
