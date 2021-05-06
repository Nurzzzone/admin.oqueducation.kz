<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_client', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->comment('Номер телефона');
            $table->string('password')->comment('Пароль');
            $table->string('user_type')->comment('Тип');
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
        Schema::dropIfExists('users_client');
    }
}
