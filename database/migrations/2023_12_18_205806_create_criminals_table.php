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
        Schema::create('criminals', function (Blueprint $table) {
            $table->id();
            $table->string('hex', 11);
            $table->foreignId('user_id');
            $table->foreignId('criminal_case_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('slug')->nullable()->unique();
            $table->text('description')->nullable();
            $table->text('personal_summary')->nullable();
            $table->datetime('date_of_birth')->nullable();
            $table->integer('year_of_birth')->nullable();
            $table->string('gender');
            $table->string('star_sign')->nullable();
            $table->string('criminal_status')->nullable();
            $table->datetime('arrest_date')->nullable();
            $table->datetime('trial_date')->nullable();
            $table->datetime('conviction_date')->nullable();
            $table->datetime('acquittal_date')->nullable();
            $table->datetime('sentencing_date')->nullable();
            $table->datetime('freed_date')->nullable();
            $table->string('sentence')->nullable();
            $table->bigInteger('main_image_id')->nullable();
            $table->integer('views');
            $table->timestamps();
            $table->string('status');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criminals');
    }
};
