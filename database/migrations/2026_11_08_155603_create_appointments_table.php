<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');

            $table->foreignId('member_id')
                  ->constrained('members', 'member_id')
                  ->cascadeOnDelete();

            $table->foreignId('trainer_id')
                  ->constrained('trainers', 'trainer_id')
                  ->cascadeOnDelete();

            $table->date('date');
            $table->time('time');
            $table->string('purpose')->nullable();
            $table->string('status')->default('Pending');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};