<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveSet extends Model
{
    protected $table = 'livesets';

    protected $fillable = [

        'title',

        'slug',

        'dj',

        'image',

        'description',

        'genre',

        'event',

        'duration',

        'youtube_url',

        'audio_url',

        'release_date',
    ];
}