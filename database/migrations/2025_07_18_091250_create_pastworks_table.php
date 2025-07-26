<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\PastWorkTag;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastworks', function (Blueprint $table) {
            $table->id();
            $table->enum('page', ['hinspector', 'hinterior', 'hconstruction', 'hbutler', 'Other']);
            $table->string('coverPageImg')->nullable();
            $table->jsonb('title');
            $table->jsonb('detail');
            $table->jsonb('images')->nullable();
            $table->foreignIdFor(PastWorkTag::class)
                ->constrained()
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
        Schema::dropIfExists('pastworks');
    }
};
