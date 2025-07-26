<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_tag_id')->constrained()->onDelete('cascade');
            $table->string('name', 100)->nullable(false);
            $table->string('locale', 5)->nullable(false); // Default locale for the tag
            $table->timestamps();

            $table->unique(['article_tag_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag_translations');
    }
};
