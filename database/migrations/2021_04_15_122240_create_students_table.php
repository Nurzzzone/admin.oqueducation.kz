<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Имя');
            $table->string('surname', 255)->comment('Фамилия');
            $table->string('middle_name', 255)->nullable()->comment('Отчество');
            $table->date('birth_date', 255)->comment('Дата рождения');
            $table->string('city', 255)->comment('Город');
            $table->string('email_address', 255)->nullable()->comment('Почта');
            $table->string('home_address', 255)->comment('Домашний Адрес');
            $table->string('image', 255)->nullable()->comment('Изображение');
            $table->foreignId('type_id')->nullable()->comment('Тип')->constrained('students_types');
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
        Schema::dropIfExists('students');
    }
}
