<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.P
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('locale', 5)->nullable(false);
            $table->string('title')->nullable(false);
            $table->text('coverPageImg')->nullable(false);
            $table->text('content')->nullable(false);
            $table->timestamps();

            $table->unique(['article_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_translations');
    }
};
