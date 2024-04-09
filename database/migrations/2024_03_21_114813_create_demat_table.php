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
        Schema::create('demat', function (Blueprint $table) {
            $table->id();
            $table->string('referred_by');
            $table->string('name');
            $table->string('phone');
            $table->string('adhar_num');
            $table->string('pan_num');
            $table->string('status')->nullable();
            $table->string('application_stage')->nullable();
            $table->date('approval_date')->nullable();
            $table->timestamps();
            $table->foreign('referred_by')->references('referral_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demat');
    }
};
