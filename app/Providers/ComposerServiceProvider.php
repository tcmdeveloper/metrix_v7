<?php

namespace App\Providers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->globalThings();
    }


    private function globalThings()
    {
        // view()->composer(array('*.*'),function($view){
        //     //get the data however you want it!
        //     $view->with('global', Setting::find(1));
        // });
        $app_settings = AppSetting::where('hex', 'Ok5kxWz9yiW')->first();
        Config::set([
            'hex' => $app_settings->hex,
            'meta_title' => $app_settings->meta_title,
            'meta_description' => $app_settings->meta_description,
            'meta_keywords' => $app_settings->meta_keywords,
            'contact_email' => $app_settings->contact_email,
            'copyright' => $app_settings->copyright,
            'powered_by' => $app_settings->powered_by,
            'powered_by_link' => $app_settings->powered_by_link,
            'allow_registration' => $app_settings->allow_registration,
            'allow_comments' => $app_settings->allow_comments,
            'facebook_url' => $app_settings->facebook_url,
            'twitter_url' => $app_settings->twitter_url,
            'youtube_url' => $app_settings->youtube_url,
            'instagram_url' => $app_settings->instagram_url,
            'discord_url' => $app_settings->discord_url,
            'content_image_width' => $app_settings->content_image_width,
            'content_image_height' => $app_settings->content_image_height,
            'pagination_items' => $app_settings->pagination_items,
            'environment' => $app_settings->environment,
            'css_assets' => $app_settings->css_assets,
            'js_assets' => $app_settings->js_assets,
            'google_analytics_tag' => $app_settings->google_analytics_tag,
            'created_at' => $app_settings->created_at,
            'updated_at' => $app_settings->updated_at,
            'site_offline' => $app_settings->site_offline
        ]);
    }
}
