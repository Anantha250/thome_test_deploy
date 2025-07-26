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
        Schema::create('past_work_tags', function (Blueprint $table) {
            $table->id();
            $table->enum('page', ['hinspector', 'hinterior', 'hconstruction', 'hbutler', 'Other']);
            $table->jsonb('title');
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
        Schema::dropIfExists('past_work_tags');
    }
};
