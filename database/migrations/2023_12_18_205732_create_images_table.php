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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('hex', 11)->unique();
            $table->foreignId('user_id');
            $table->string('resource_model');
            $table->bigInteger('resource_id');
            $table->string('directory')->nullable();
            $table->string('filename');
            $table->string('bg_position')->nullable();
            $table->string('caption')->nullable();
            $table->string('copyright')->nullable();
            $table->string('copyright_link')->nullable();
            $table->timestamps();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
