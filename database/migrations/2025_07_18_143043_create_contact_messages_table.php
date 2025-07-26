<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 50);
            $table->string('subject', 100);
            $table->string('subject_display');
            $table->text('message');
            $table->enum('status', ['new', 'read', 'replied', 'closed'])->default('new');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            // Add indexes for better performance
            $table->index('email');
            $table->index('status');
            $table->index('subject');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_messages');
    }
};
