<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_parents', function (Blueprint $table) {
            $table->id();
            $table->string('p1_full_name', 255)->comment('ФИО родителя 1');
            $table->string('p1_phone_number', 255)->comment('Номер телефона родителя1');
            $table->string('p2_full_name', 255)->nullable()->comment('ФИО родителя 2');
            $table->string('p2_phone_number', 255)->nullable()->comment('Номер телефона родителя 2');
            $table->foreignId('student_id')->comment('Ученик')->constrained('students')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('students_parents');
    }
}
