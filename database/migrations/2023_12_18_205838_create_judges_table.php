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
        Schema::create('judges', function (Blueprint $table) {
            $table->id();
            $table->string('hex', 11)->unique();
            $table->foreignId('user_id');
            $table->foreignId('criminal_case_id');
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('slug')->unique();
            $table->string('bio')->nullable();
            $table->string('gender');
            $table->integer('appointed')->nullable();
            $table->integer('retired')->nullable();
            $table->string('court')->nullable();
            $table->foreignId('county_id')->nullable();
            $table->foreignId('state_id')->nullable();
            $table->string('main_image_id')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judges');
    }
};
