<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Judge extends Model
{
    use HasFactory;


    // DATABASE COLUMNS FOR MASS ASSIGNMENT

    protected $fillable = [
        'hex',
        'user_id',
        'criminal_case_id',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'slug',
        'bio',
        'gender',
        'appointed',
        'retired',
        'court',
        'county_id',
        'state_id',
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
            'directory' => 'judges',
            'label' => 'judge',
            'plural' => 'judges',
        );

        return $data;

    }




    // MUTATORS


    public function getTitleAttribute($date){

        return $this->fullName();
            
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
            return $this->hasMany(ImageSmash::class, 'resource_id', 'id')->where('resource_model', 'Judge');
        }


        // MAIN IMAGE

        public function main_image(): HasOne
        {
            return $this->hasOne(ImageSmash::class, 'id', 'main_image_id');
        }


        // COUNTY

        public function county(): BelongsTo
        {
            return $this->belongsTo(County::class);
        }


        // STATE

        public function state(): BelongsTo
        {
            return $this->belongsTo(State::class);
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

        return 'The Honourable Judge '.$this->fullName().' - '.config('app.name');

    }




    // FORMATTERS


        // FULL NAME OF JUDGE

        public function fullName($acceptInput = false, $first_name = null, $last_name = null){

            if($acceptInput)
                return $first_name.' '.$last_name;
            
            return $this->first_name.' '.$this->last_name;

        }




// END OF MODEL

}