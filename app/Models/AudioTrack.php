<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AudioTrack extends Model
{
    use HasFactory;

    protected $table = 'audio_tracks';

    protected $fillable = [
        'audio_id',
        'title',
        'file_path',
        'duration',
        'track_number',
    ];

    public function audio()
    {
        return $this->belongsTo(Audio::class, 'audio_id');
    }
}
