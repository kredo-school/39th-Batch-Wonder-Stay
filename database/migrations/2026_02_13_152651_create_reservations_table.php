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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hotel_id')->constrained()->cascadeOnDelete();
            $table->foreignId('hotel_detail_id')
                ->nullable()
                ->constrained('hotel_details')
                ->nullOnDelete();

            $table->foreignId('payment_method_id')
            ->constrained()
            ->restrictOnDelete();

            // guest info
            $table->string('guest_first_name');
            $table->string('guest_last_name');
            $table->unsignedTinyInteger('guest_age');
            $table->string('guest_email');
            $table->string('guest_address')->nullable();
            $table->string('guest_phone')->nullable();

            // accommodation
            $table->unsignedTinyInteger('guests_count');
            $table->unsignedTinyInteger('rooms_count')->default(1);
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->time('check_in_time')->nullable();
            $table->string('special_request')->nullable();

            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled',
                'completed'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
