<?php

use App\Models\ReviewHome;
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
        Schema::create('review_home_hashtags', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ReviewHome::class, 'review_home_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->jsonb('locale')->nullable(); // JSON column for storing localized hash tags
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
        Schema::dropIfExists('review_home_hashtags');
    }
};
