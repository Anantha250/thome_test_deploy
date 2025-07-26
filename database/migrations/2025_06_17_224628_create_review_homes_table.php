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
        Schema::create('review_homes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('folder_id')->unsigned()->default(0)->nullable();
            $table->foreignIdFor(\App\Models\ReviewHomeProject::class, 'project_id')
                ->constrained('review_home_projects')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('review_homes');
    }
};
