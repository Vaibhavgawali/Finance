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
        Schema::create('credit_card', function (Blueprint $table) {
            $table->id();     
            $table->string('referred_by');
            $table->string('card');
            $table->string('name');
            $table->string('pan_num');
            $table->string('adhar_num');
            $table->string('email');
            $table->string('mobile');
            $table->string('status')->nullable();
            $table->string('application_stage')->nullable();
            $table->date('approval_date')->nullable();
            $table->decimal('annual_income', 10, 2);
            $table->text('residence_address');
            $table->text('office_address');
            $table->string('pan_file')->nullable();
            $table->string('adhar_front_file')->nullable();
            $table->string('adhar_back_file')->nullable();
            $table->string('itr_file')->nullable();
            $table->string('bank_statement_file')->nullable();
            $table->timestamps();
            $table->foreign('referred_by')->references('referral_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_card');
    }
};
