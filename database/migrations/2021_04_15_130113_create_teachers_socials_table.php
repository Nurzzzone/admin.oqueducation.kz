<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers_socials', function (Blueprint $table) {
            $table->id();
            $table->string('facebook_url')->comment('Facebook');
            $table->string('instagram_url')->comment('Instagram');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('teachers_socials');
    }
}
