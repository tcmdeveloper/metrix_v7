<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Monarobase\CountryList\CountryListFacade;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    
    // -----------------------------------------------------
    // ATTRIBUTES
    // -----------------------------------------------------


    // Attributes for mass-assignment

    protected $fillable = [
        'hex',
        'email',
        'password',
        'google_id',
        'username',
        'display_name',
        'first_name',
        'last_name',
        'avatar',
        'country_code',
        'state_code',
    ];


    // Attributes hidden for serialization

    protected $hidden = [
        'password',
        'remember_token',
    ];
    

    // Attributes that should be cast

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




    // -----------------------------------------------------
    // ROUTE KEY
    // -----------------------------------------------------


    // Set route key

    public function getRouteKeyName()
    {
        return 'hex';   
    }


    // Retrieve route key value

    public function routeKeyValue()
    {
        $routeKeyValue = $this->getRouteKeyName();
        return $this->$routeKeyValue;
    }




    // -----------------------------------------------------
    // ELOQUENT ACCESSORS: GET ATTRIBUTES
    // -----------------------------------------------------


    // Full name

    public function getFullNameAttribute(): ?string
    {
        if (!$this->first_name && !$this->last_name) {
            return null;
        }

        return trim($this->first_name . ' ' . $this->last_name);
    }


    // Avatar URL

    public function getAvatarUrlAttribute()
    {
        return $this->avatar
            ?: asset('images/default-avatar.png');
    }


    // User handle

    public function getUserHandleAttribute()
    {
        $userHandle = $this->display_name ?: $this->fullName;
        return $userHandle;
    }


    // Country name   

    public function getCountryNameAttribute(): ?string
    {
        return $this->country_code
            ? CountryListFacade::getOne($this->country_code)
            : null;
    }

    
    // State name 
    
    public function getStateNameAttribute(): ?string
    {
        return $this->state_code
            ? (config('states')[$this->state_code] ?? null)
            : null;
    }




    // -----------------------------------------------------
    // RENDERERS
    // -----------------------------------------------------
    
    
    // Short name

    public function shortName()
    {
        return substr($this->first_name, 0, 2).substr($this->last_name, 0, 1);
    }


    
}
