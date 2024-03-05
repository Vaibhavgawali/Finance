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
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('father_name',60)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender',['M','F','O'])->nullable();
            $table->string('age')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string("profile_image")->nullable();
            $table->string('pan', 10)->nullable();
            $table->boolean('gst')->nullable();
            $table->boolean('msme')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile');
    }
};
