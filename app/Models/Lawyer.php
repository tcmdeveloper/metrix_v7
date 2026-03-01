<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImageSmash;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lawyer extends Model
{
    use HasFactory;


    // DATABASE COLUMNS FOR MASS ASSIGNMENT

    protected $fillable = [
        'hex',
        'user_id',
        'criminal_case_id',
        'first_name',
        'last_name',
        'slug',
        'dob_day',
        'dob_month',
        'dob_year',
        'gender',
        'star_sign',
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
            'directory' => 'lawyers',
            'label' => 'lawyer',
            'plural' => 'lawyers',
        );

        return $data;

    }




    // MODEL RELATIONSHIPS


        // CRIMINAL CASE

        public function criminal_case(): BelongsTo
        {
            return $this->belongsTo(CriminalCase::class);
        }


        // IMAGES

        public function images(): HasMany
        {
            return $this->hasMany(ImageSmash::class, 'resource_id', 'id')->where('resource_model', 'Lawyer');
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

        return $this->fullName().' - '.config('app.name');

    }




    // FORMATTERS


        // FULL NAME OF CRIMINAL

        public function fullName($acceptInput = false, $first_name = null, $last_name = null){

            if($acceptInput)
                return $first_name.' '.$last_name;
            
            return $this->first_name.' '.$this->last_name;

        }




// END OF MODEL
    
}