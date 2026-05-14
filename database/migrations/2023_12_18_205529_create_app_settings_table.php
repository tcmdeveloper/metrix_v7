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

        Schema::dropIfExists('app_settings');
        
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hex', 11)->unique();
            $table->string('meta_title');
            $table->text('meta_description');
            $table->string('meta_keywords');
            $table->string('meta_author')->nullable();
            $table->string('meta_image')->nullable();
            $table->string('contact_email');
            $table->string('copyright');
            $table->string('powered_by');
            $table->string('powered_by_link');
            $table->boolean('allow_registration');
            $table->boolean('allow_comments');
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->integer('content_image_width');
            $table->integer('content_image_height');
            $table->integer('pagination_items');
            $table->string('environment');
            $table->string('css_assets');
            $table->string('js_assets');
            $table->string('google_analytics_tag')->nullable();
            $table->timestamps();
            $table->boolean('site_offline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
