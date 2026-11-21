<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')
                  ->constrained('members')
                  ->cascadeOnDelete();

            $table->foreignId('trainer_id')
                  ->constrained('trainers')
                  ->cascadeOnDelete();

            $table->date('appointment_date');
            $table->time('appointment_time');

            $table->string('purpose');

            $table->enum('status', [
                'Pending',
                'Confirmed',
                'Completed',
                'Cancelled'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};