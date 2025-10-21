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
        Schema::create('monthly_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained()->onDelete('cascade'); // UNIT ID, FOREIGN KEY
            $table->string('year');
            $table->string('month');
            $table->enum('paid_status', ['full', 'none']);

            // BORROWED IN UNIT TABLE
            $table->decimal('rent_ammount');

            // WATER
            $table->decimal('water_prev_reading');
            $table->decimal('water_present_reading');
            $table->decimal('water_consumption');
            $table->decimal('water_charged');

            // ELECTRIC
            $table->decimal('elec_prev_reading');
            $table->decimal('elec_present_reading');
            $table->decimal('elec_consumption');
            $table->decimal('elec_charged');

            // TOTAL
            $table->decimal('charges_total');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_summaries');
    }
};
