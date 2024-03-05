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
        Schema::create('address_proof_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_document_id');
            $table->string('address_proof_name')->nullable(); 
            $table->string('document_number')->nullable();
            $table->timestamps();
            $table->foreign('user_document_id')->references('id')->on('user_documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_proof_documents');
    }
};
