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
        Schema::create('jobwork_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Jobwork::class)->constrained()->onDelete('cascade');
            $table->string('locale', 5);
            $table->string('position');
            $table->string('requirements');
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
        Schema::dropIfExists('jobwork_translations');
    }
};
