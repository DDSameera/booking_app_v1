<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            // Optional user (guest bookings allowed)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Room & stay
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->date('check_in');
            $table->date('check_out');
            $table->unsignedInteger('guests');

            // Guest contact (for public/guest bookings)
            $table->string('full_name', 120);
            $table->string('email');
            $table->string('phone', 30)->nullable();

            // Pricing & status
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('confirmed');  // confirmed|cancelled
            $table->string('reference')->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
