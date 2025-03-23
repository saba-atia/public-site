<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade'); // ✅ تأكد من وجود هذا السطر
            $table->date('booking_date');
            $table->time('booking_time');
            $table->decimal('total_price', 8, 2)->default(0);
            $table->string('status')->default('pending');
            $table->boolean('breakfast')->default(false);
            $table->boolean('lunch')->default(false);
            $table->boolean('dinner')->default(false);
            $table->boolean('room_service')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('wifi')->default(false);
            $table->boolean('gym')->default(false);
            $table->boolean('pool')->default(false);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
