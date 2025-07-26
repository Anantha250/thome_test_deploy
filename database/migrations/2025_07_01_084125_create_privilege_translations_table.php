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
        Schema::create('privilege_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Privilege::class, 'privilege_id')
                ->constrained('privileges')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('locale', 5)->nullable(false);
            $table->string('title')->nullable(false);
            $table->text('coverPageImg')->nullable(false);
            $table->text('content')->nullable(false);

            $table->timestamps();
            $table->unique(['privilege_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilege_translations');
    }
};
