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
        Schema::table('loan', function (Blueprint $table) {
            $table->string('pan_file')->nullable();
            $table->string('adhar_front_file')->nullable();
            $table->string('adhar_back_file')->nullable();
            $table->string('itr_file')->nullable();
            $table->string('bank_statement_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan', function (Blueprint $table) {
            $table->dropColumn('pan_file');
            $table->dropColumn('adhar_front_file');
            $table->dropColumn('adhar_back_file');
            $table->dropColumn('itr_file');
            $table->dropColumn('bank_statement_file');
        });
    }
};
