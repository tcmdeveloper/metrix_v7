<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    // DATABASE COLUMNS FOR MASS ASSIGNMENT

    protected $fillable = [
        'source',
        'videoId',
        'fileName',
        'status',
        'error'
    ];
}
