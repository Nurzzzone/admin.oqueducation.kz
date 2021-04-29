<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Вопрос');
            $table->string('image', 255)->comment('Изображение');
            $table->foreignId('class_id')->comment('Урок')->constrained('classes')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('classes_questions');
    }
}