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
        Schema::create('loan_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->string('present_line1');
            $table->string('present_line2')->nullable();
            $table->string('present_line3')->nullable();
            $table->string('present_landmark')->nullable();
            $table->string('present_state');
            $table->string('present_city');
            $table->string('present_pincode');
            $table->string('present_phone')->nullable();
            $table->string('office_line1');
            $table->string('office_line2')->nullable();
            $table->string('office_line3')->nullable();
            $table->string('office_landmark')->nullable();
            $table->string('office_state');
            $table->string('office_city');
            $table->string('office_pincode');
            $table->string('office_phone')->nullable();
            $table->timestamps();
            $table->foreign('loan_id')->references('id')->on('loan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_address');
    }
};
