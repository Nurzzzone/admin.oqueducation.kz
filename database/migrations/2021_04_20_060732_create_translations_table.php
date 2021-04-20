<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('translation', 255)->comment('Перевод');
            $table->boolean('status')->comment('Статус');
            $table->string('message_id')->nullable()->comment('Сообщение')->constrained('translations_messages');
            $table->foreignId('language_id')->nullable()->comment('Язык')->constrained('translations_languages');
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
        Schema::dropIfExists('translations');
    }
}
