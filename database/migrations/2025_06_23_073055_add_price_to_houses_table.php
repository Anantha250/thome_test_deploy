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
        Schema::table('houses', function (Blueprint $table) {
            if (!Schema::hasColumn('houses', 'price')) {
                $table->decimal('price', 15, 2)->nullable()->after('image');
            }
        });
    }

    public function down()
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
};
