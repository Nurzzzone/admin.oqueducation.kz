<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersJhistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_jhistory', function (Blueprint $table) {
            $table->id();
            $table->string('position', 255)->comment('Должность');
            $table->string('workplace', 255)->comment('Место работы');
            $table->date('start_date')->comment('Начало работы');
            $table->date('end_date')->comment('Конец работы');
            $table->foreignId('teacher_id')->comment('Учитель')->constrained('teachers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('teachers_jhistory');
    }
}
