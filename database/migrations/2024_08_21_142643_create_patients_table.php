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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->default(0);
            $table->unsignedBigInteger('customer_id')->default(0);
            $table->string('name');
            $table->string('gender');
            $table->dateTime('date_of_birth')->nullable();
            //todo add date of death and create filtering options
            $table->text('medical_history_summary')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->index('customer_id');

            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->index('organization_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};