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
        Schema::create('loan', function (Blueprint $table) {
            $table->id();
            $table->string('referred_by');
            $table->enum('loan_type', ['Home Loan', 'Business Loan', 'Personal Loan', 'Vehicle Loan']);
            $table->string('mobile');
            $table->string('name');
            $table->enum('income_source', ['Salaried', 'Business']);
            $table->string('email');
            $table->string('status')->nullable();
            $table->string('application_stage')->nullable();
            $table->date('approval_date')->nullable();
            $table->decimal('monthly_income', 10, 2);
            $table->string('pincode');
            $table->string('adhar_num');
            $table->date('dob');
            $table->decimal('loan_amount', 10, 2);
            $table->string('pan_num');
            $table->integer('credit_score');
            $table->enum('marital_status', ['married', 'unmarried']);
            $table->string('mother_name');
            $table->enum('document_type', [
                'pancard',
                'adhar_front_file',
                'year_itr',
                'one_year_bank_statement',
                'ownership_proof_residence',
                'certificate_of_incorporation',
                'gst_certificate_msme_certificate',
                'gst_return',
                'office_address_proof',
                'moa_aoa_ms',
                'trade_license',
                'photo',
                'other'
            ]);
            $table->string('upload_document')->nullable();
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
        Schema::dropIfExists('loan');
    }
};
