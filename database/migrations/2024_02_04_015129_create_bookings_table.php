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
            $table->ulid('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mentor_user_id');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->decimal('price_after_hours', 12, 0);
            $table->decimal('tax_cost', 12, 0);
            $table->decimal('career_insurance_cost', 12, 0);
            $table->decimal('add_on_tools_cost', 12, 0);
            $table->decimal('grand_total', 12, 0);
            $table->unsignedTinyInteger('status')->comment('1 = PENDING, 2 = APPROVED, 3 = REJECTED');
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
