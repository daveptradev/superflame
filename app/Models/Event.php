<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [

        'title',

        'slug',

        'image',

        'date',

        'location',
        
        'headliner',

        'description',

        'lineup',

        'status',
    ];
}