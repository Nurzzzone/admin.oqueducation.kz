<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name'. 255)->comment('Задание');
            $table->string('image', 255)->nullable()->comment('Изображение');
            $table->text('hint', 255)->nullable()->comment('Подсказка');
            $table->foreignId('hometask_id')->comment('Домашнее задание')->constrained('classes_hometasks')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('classes_tasks');
    }
}
