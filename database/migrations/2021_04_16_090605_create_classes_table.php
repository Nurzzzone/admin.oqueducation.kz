<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->comment('Название');
            $table->string('source_url', 255)->nullable()->comment('Источник');
            $table->boolean('is_active')->comment('Отображение');
            $table->foreignId('subject_id')->nullable()->constrained('subjects');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers');
            $table->foreignId('type_id')->nullable()->constrained('classes_types');
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
        Schema::dropIfExists('classes');
    }
}
