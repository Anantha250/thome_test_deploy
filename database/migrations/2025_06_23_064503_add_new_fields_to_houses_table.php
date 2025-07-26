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
            // ตรวจสอบก่อนว่ามีหรือยังใน DB

            if (!Schema::hasColumn('houses', 'total_score')) {
                $table->decimal('total_score', 5, 1)->nullable();
            }

            if (!Schema::hasColumn('houses', 'wall_structure')) {
                $table->string('wall_structure')->nullable();
            }
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }

};
