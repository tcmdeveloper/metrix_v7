<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // SEED FROM IMPORT DATABASE

        $model = new AppSetting();
        
        $items = $model::on('mysql_import')->get();

        foreach($items as $item){
            $model::create([
                'hex' => $item->hex,
                
                'meta_title' => $item->meta_title,
                'meta_description' => $item->meta_description,
                'meta_keywords' => $item->meta_keywords,
                'meta_author' => $item->meta_author,
                'meta_image' => $item->meta_image,
                'contact_email' => $item->contact_email,
                'copyright' => $item->copyright,
                'powered_by' => $item->powered_by,
                'powered_by_link' => $item->powered_by_link,
                'allow_registration' => $item->allow_registration,
                'allow_comments' => $item->allow_comments,
                'facebook_url' => $item->facebook_url,
                'twitter_url' => $item->twitter_url,
                'youtube_url' => $item->youtube_url,
                'instagram_url' => $item->instagram_url,
                'content_image_width' => $item->content_image_width,
                'content_image_height' => $item->content_image_height,
                'pagination_items' => $item->pagination_items,
                'environment' => $item->environment,
                'css_assets' => $item->css_assets,
                'js_assets' => $item->js_assets,
                'google_analytics_tag' => $item->google_analytics_tag,
                'site_offline' => $item->site_offline
            ]);
        }
    }


        // SEED FROM ARRAY

    //     $model = new AppSetting();

    //     $items = [
    //         [
    //             'hex' => Str::random(11),
    //             'meta_title' => 'True Crime Metrix - More than just truew crime news.',
    //             'meta_description' => 'We are stacked with information from all your favourite True Crime cases.',
    //             'meta_keywords' => 'true crime, crime news, true crime news, trial news',
    //             'contact_email' => 'hello@truecrimemetrix.com',
    //             'copyright' => 'True Crime Metrix, Inc.',
    //             'powered_by' => 'Soapboxcoder',
    //             'powered_by_link' => 'https://soapboxcoder.com',
    //             'allow_registration' => false,
    //             'allow_comments' => false,
    //             'facebook_url' => null,
    //             'twitter_url' => null,
    //             'youtube_url' => null,
    //             'instagram_url' => null,
    //             'content_image_width' => 960,
    //             'content_image_height' => 540,
    //             'pagination_items' => 12,
    //             'site_offline' => false,
    //         ]
    //     ];

    //     foreach($items as $item){
    //         $model::create($item);
    //     }
    // }
}
