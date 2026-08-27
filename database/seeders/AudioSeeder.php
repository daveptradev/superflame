<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Audio;

class AudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Audio::updateOrCreate(
            ['slug' => 'supernova-edit-pack'],
            [
                'title'        => 'SUPERNOVA EDIT PACK',
                'artist'       => 'SUPERFLAME',
                'category'     => 'EDIT PACK',
                'description'  => 'Raw industrial grooves and underground energy recorded live during SUPERFLAME sessions.',
                'image'        => 'audio/supernova.png',
                'audio_url'    => 'https://soundcloud.com/superflame99/sets/supernova',
                'audio_file'   => null,
                'buy_url'      => 'https://lynk.id/superflame',
                'buy_label'    => 'Buy Now',
                'release_date' => now()->format('Y-m-d'),
            ]
        );
    }
}
