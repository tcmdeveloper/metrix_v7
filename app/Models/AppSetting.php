<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;


    // DATABASE COLUMNS FOR MASS ASSIGNMENT

    protected $fillable = [
        'hex',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'meta_image',
        'contact_email',
        'copyright',
        'powered_by',
        'powered_by_link',
        'allow_registration',
        'allow_comments',
        'facebook_url',
        'twitter_url',
        'youtube_url',
        'instagram_url',
        'discord_url',
        'environment',
        'css_assets',
        'js_assets',
        'content_image_width',
        'content_image_height',
        'pagination_items',
        'site_offline'
    ];
    
    
    
    
    // ROUTE KEY


    // SET ROUTE KEY NAME

    public function getRouteKeyName(){

        return 'hex';
            
    }


    // RETRIEVE ROUTE KEY VALUE
    public function routeKeyValue(){

        $routeKeyValue = $this->getRouteKeyName();
        return $this->$routeKeyValue;

    }




// END OF MODEL

}
