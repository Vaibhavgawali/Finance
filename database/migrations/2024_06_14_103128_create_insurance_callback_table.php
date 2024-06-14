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
        Schema::create('insurance_callback', function (Blueprint $table) {
            $table->id();
            $table->string('referred_by');
            $table->string('InsurerID');
            $table->string('InsurerName');
            $table->string('EnquiryType');
            $table->string('TotalPremium');
            $table->string('EnquiryNo');
            $table->string('PolicyNo');
            $table->string('PolicyStatus');
            $table->string('VehicleNo')->nullable();
            $table->string('PolicyHolderName');
            $table->string('status')->nullable();
            $table->date('approval_date')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();

            $table->foreign('referred_by')->references('referral_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_callback');
    }
};
