<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    protected $table = 'audios';

    protected $fillable = [
        'title',
        'slug',
        'artist',
        'category',
        'description',
        'image',
        'audio_url',
        'audio_file',
        'buy_url',
        'buy_label',
        'release_date',
    ];
}
