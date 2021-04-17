<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Имя');
            $table->string('surname', 255)->comment('Фамилия');
            $table->string('middle_name', 255)->nullable()->comment('Отчество');
            $table->string('birth_date', 255)->nullable()->comment('Дата рождения');
            $table->string('email_address', 255)->nullable()->comment('Почта');
            $table->string('phone_number', 255)->nullable()->comment('Номер телефона');
            $table->string('image', 255)->nullable()->comment('Изображение');
            $table->string('position', 255)->nullable()->comment('Должность');
            $table->text('description')->nullable()->comment('Описание');
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
        Schema::dropIfExists('teachers');
    }
}
