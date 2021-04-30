<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_answers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Ответ');
            $table->string('image', 255)->nullable()->comment('Изображение');
            $table->foreignId('question_id')->comment('Вопрос')->constrained('classes_questions')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('classes_answers');
    }
}
