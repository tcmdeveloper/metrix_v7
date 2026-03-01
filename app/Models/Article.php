<?php

namespace App\Models;

use App\Models\ImageSmash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;


    // DATABASE COLUMNS FOR MASS ASSIGNMENT

    protected $fillable = [
        'hex',
        'user_id',
        'resource_model',
        'resource_id',
        'title',
        'slug',
        'subtitle',
        'introduction',
        'body',
        'main_image_id',
        'views',
        'status'
    ];




    // ROUTE KEY


    // SET ROUTE KEY NAME

    public function getRouteKeyName(){

        return 'slug';
        
    }


    // RETRIEVE ROUTE KEY VALUE
    public function routeKeyValue(){

        $routeKeyValue = $this->getRouteKeyName();
        return $this->$routeKeyValue;

    }





    // GET MODEL DATA


    public function getModelData(){

        $data = (object) array(
            'name' => class_basename(__CLASS__),
            'directory' => 'articles',
            'label' => 'article',
            'plural' => 'articles',
        );
        
        return $data;

    }




    // MODEL RELATIONSHIPS


        // CRIMINAL CASE

        public function criminal_case(): BelongsTo
        {
            return $this->belongsTo(CriminalCase::class, 'resource_id', 'id');
        }


        // IMAGES

        public function images(): HasMany
        {
            return $this->hasMany(ImageSmash::class, 'resource_id', 'id')->where('resource_model', 'Article');
        }


        // MAIN IMAGE

        public function main_image(): HasOne
        {
            return $this->hasOne(ImageSmash::class, 'id', 'main_image_id');
        }


        // USER

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }




    // RESOURCE LINK URL
    
    public function link($extended_path = null){

        $path = '/'.self::getModelData()->directory.'/'.$this->routeKeyValue();

        if($extended_path)
            return $path.'/'.$extended_path;

        return $path;

    }


    // RESOURCE LINK ARIA LABEL

    public function linkLabel(){

        return 'View '.self::getModelData()->label.': '.$this->title;

    }




    // FETCH IMAGE FOR THIS RESOURCE

    public function fetchImage($fetch_main = false, $size = null){

        $image = new ImageSmash();
        return $image->fetch($this, $fetch_main, $size);

    }


    // IMAGE ALT TEXT

    public function imageAltText(){

        return $this->title.' - '.config('app.name');
        
    }




// END OF MODEL
    
}
