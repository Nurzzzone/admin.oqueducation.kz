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
            $table->string('name')->comment('Задание');
            $table->text('hint', 255)->comment('Подсказка');
            $table->foreignId('hometask_id')->comment('Домашнее задание')->constrained('hometasks')->onUpdate('cascade')->onDelete('cascade');
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
