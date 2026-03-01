<?php

namespace App\Models;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CriminalCase extends Model
{
    use HasFactory;

    
    // DATABASE COLUMNS FOR MASS ASSIGNMENT

    protected $fillable = [
        'hex',
        'user_id',
        'title',
        'slug',
        'short_name',
        'category_id',
        'caption',
        'description',
        'state_id',
        'city_id',
        'views',
        'image',
        'image_caption',
        'image_copyright',
        'image_copyright_link',
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
            'directory' => 'criminal-cases',
            'label' => 'criminal case',
            'plural' => 'criminal cases',
        );

        return $data;

    }




     // MUTATORS


        public function getCriminalCaseAttribute($date){

            return $this;
                
        }




    // MODEL RELATIONSHIPS


        // CATEGORY

        public function category(): BelongsTo
        {
            return $this->belongsTo(Category::class);
        }



        // CRIMINALS
    
        public function criminals(): HasMany
        {
            return $this->hasMany(Criminal::class, 'criminal_case_id', 'id');
        }


        // JUDGES

        public function judges(): HasMany
        {
            return $this->hasMany(Judge::class, 'criminal_case_id', 'id');
        }


        // ARTICLES

        public function articles(): HasMany
        {
            return $this->hasMany(Article::class, 'resource_id', 'id');
        }


        // ARTICLES

        public function documents(): HasMany
        {
            return $this->hasMany(Document::class, 'resource_id', 'id');
        }


        // IMAGES

        public function images(): HasMany
        {
            return $this->hasMany(ImageSmash::class, 'resource_id', 'id')->where('resource_model', 'CriminalCase');
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


        // CITY

        public function city(): BelongsTo
        {
            return $this->belongsTo(City::class);
        }


        // STATE

        public function state(): BelongsTo
        {
            return $this->belongsTo(State::class);
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


    // FETCH IMAGE FOR THIS RESOURCE

    public function fetchByImageHex($image_hex = null, $size = null){

        $image = new ImageSmash();
        return $image->fetchByImageHex($this, $image_hex, $size);

    }


    // IMAGE ALT TEXT

    public function imageAltText(){

        return $this->title.' - '.config('app.name');

    }


    // FETCH BG IMAGE POSITION

    public function fetchBgImagePosition(string $bg_position = 'center'){

        $image = new ImageSmash();
        return $image->fetchBgPosition($this, $bg_position);

    }




// END OF MODEL

}
