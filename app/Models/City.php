<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
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




    // CREATE NEW CITY IF IT DOES NOT EXIST    

    public static function createIfDoesNotExist($request){

        $city = City::where('name', ucwords($request->city))
            ->where('state_id', $request->state_id)
            ->get()
            ->first();
        
        if($city)
            return $city->id;

        return self::createCity($request);

    }




    // CREATE CITY

    public static function createCity($request){

        $new_city = City::create([
            'hex' => Str::random(11),
            'state_id' => $request->state_id,
            'name' => ucwords($request->city),
            'slug' => Str::slug(ucwords($request->city)) 
        ]);

        return $new_city->id;

    }




// END OF MODEL

}
