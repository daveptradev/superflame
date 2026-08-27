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

    public function tracks()
    {
        return $this->hasMany(AudioTrack::class, 'audio_id')->orderBy('track_number')->orderBy('id');
    }

    public function activeTracks()
    {
        return $this->hasMany(AudioTrack::class, 'audio_id')->where('is_active', true)->orderBy('track_number')->orderBy('id');
    }
}
