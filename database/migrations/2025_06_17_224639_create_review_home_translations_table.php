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
        Schema::create('review_home_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ReviewHome::class, 'review_home_id')
                ->constrained('review_homes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('locale', 5)->nullable(false);
            $table->string('title')->nullable(false);
            $table->text('coverPageImg')->nullable(false);
            $table->text('content')->nullable(false);
            $table->timestamps();

            $table->unique(['review_home_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_home_translations');
    }
};
