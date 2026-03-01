<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class County extends Model
{
    use HasFactory;


    // NO TIMESTAMPS IN DATA TABLE

    public $timestamps = false;




    // DATABASE COLUMNS FOR MASS ASSIGNMENT

    protected $fillable = [
        'hex',
        'state_id',
        'name',
        'slug'
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




    // CREATE NEW COUNTY IF IT DOES NOT EXIST 

    public static function createIfDoesNotExist($request){

        $county = County::where('name', ucwords($request->county))
            ->where('state_id', $request->state_id)
            ->get()
            ->first();

        if($county)
            return $county->id;

        return self::createCounty($request);

    }




    // CREATE COUNTY

    public static function createCounty($request){

        $new_county = County::create([
            'hex' => Str::random(11),
            'state_id' => $request->state_id,
            'name' => ucwords($request->county),
            'slug' => Str::slug(ucwords($request->county)) 
        ]);

        return $new_county->id;

    }




// END OF MODEL

}
