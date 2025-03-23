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
        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('breakfast')->default(0)->after('status');
            $table->boolean('lunch')->default(0)->after('breakfast');
            $table->boolean('dinner')->default(0)->after('lunch');
            $table->boolean('room_service')->default(0)->after('dinner');
            $table->boolean('parking')->default(0)->after('room_service');
            $table->boolean('wifi')->default(0)->after('parking');
            $table->boolean('gym')->default(0)->after('wifi');
            $table->boolean('pool')->default(0)->after('gym');
        });
    }
    
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'breakfast',
                'lunch',
                'dinner',
                'room_service',
                'parking',
                'wifi',
                'gym',
                'pool',
            ]);
        });
    }
};
