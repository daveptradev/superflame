@extends('layouts.app')

@section('title', 'Audio - Superflame')

@section('content')

<!-- AUDIO LIST -->
<section class="px-4 md:px-6 pt-14 pb-20 bg-[#0a0a0a]">

    <div class="w-full max-w-[1500px] mx-auto">

        <!-- TITLE -->
        <div class="text-center mb-10">

            <div>

                <p class="text-xs tracking-[4px] text-red-500 uppercase mb-3">
                    Latest Drops
                </p>

                <h2 class="text-3xl md:text-5xl font-extrabold text-white">
                    FEATURED AUDIO
                </h2>
                
                <!-- SOCIAL LINKS -->
                <div class="flex items-center justify-center gap-5 mt-4">
                
                    <!-- SOUNDCLOUD -->
                    <a href="https://on.soundcloud.com/a5YxeldtBGouScEJYH"
                       target="_blank"
                       class="text-gray-500 hover:text-orange-500 transition duration-300 hover:scale-110">
                
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-7 h-7">
                
                            <path d="M17.812 10.04c-.294 0-.58.034-.854.098a4.85 4.85 0 00-4.556-3.23 4.84 4.84 0 00-1.964.41.45.45 0 00-.27.41v8.61a.45.45 0 00.45.45h7.194a3.374 3.374 0 000-6.748zM6.21 8.842a.45.45 0 00-.45.45v6.944a.45.45 0 10.9 0V9.292a.45.45 0 00-.45-.45zm-2.11 1.366a.45.45 0 00-.45.45v5.578a.45.45 0 10.9 0v-5.578a.45.45 0 00-.45-.45zm4.22-2.18a.45.45 0 00-.45.45v7.758a.45.45 0 10.9 0V8.478a.45.45 0 00-.45-.45z"/>
                        </svg>
                
                    </a>
                
                    <!-- BANDCAMP -->
                    <a href="https://superflame.bandcamp.com/album/supernova"
                       target="_blank"
                       class="text-gray-500 hover:text-cyan-400 transition duration-300 hover:scale-110">
                
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-7 h-7">
                
                            <path d="M2 18L9.5 6H22l-7.5 12H2z"/>
                        </svg>
                
                    </a>
                
                </div>
                
                <!-- CATEGORY -->
                <div class="flex items-center justify-center gap-8 mt-4">
                
                    <button
                        class="text-sm md:text-base font-semibold tracking-[2px]
                        text-white border-b-2 border-red-500 pb-2">
                
                        ALL
                
                    </button>
                
                    <button
                        class="text-sm md:text-base font-semibold tracking-[2px]
                        text-gray-500 hover:text-white transition pb-2">
                
                        TRACKS
                
                    </button>
                
                    <button
                        class="text-sm md:text-base font-semibold tracking-[2px]
                        text-gray-500 hover:text-white transition pb-2">
                
                        ALBUM
                
                    </button>
                
                </div>

            </div>

        </div>

        <!-- GRID -->
        <div class="grid md:grid-cols-2 gap-8">

            <!-- CARD -->
            <div class="audio-card relative group bg-[#111] border border-white/5 rounded-3xl overflow-hidden hover:border-red-500/40 transition duration-500">

                <!-- IMAGE ONLY CLICKABLE -->
                <a
                href="https://soundcloud.com/superflame99/sets/supernova"
                target="_blank"
                class="block relative overflow-hidden">

                    <img
                        src="{{ asset('storage/audio/supernova.png') }}"
                        class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-700">

                    <div class="absolute inset-0 bg-black/30"></div>

                </a>

                <!-- INFO -->
                <div class="p-7">

                    <div class="flex items-center justify-between mb-4">

                        <span class="text-xs tracking-[3px] uppercase text-red-500">
                            SUPERFLAME
                        </span>

                    </div>

                    <h3 class="text-2xl font-extrabold text-white mb-3">
                        SUPERNOVA EDIT PACK
                    </h3>

                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Raw industrial grooves and underground energy recorded live during SUPERFLAME sessions.
                    </p>
                    
                    <!-- BUTTON -->
                    <div class="flex justify-end">

                        <button 
                        onclick="window.open('https://lynk.id/superflame', '_blank')"
                        class="px-5 py-2 border border-red-500 text-red-500
                        text-xs tracking-[3px] uppercase
                        hover:bg-red-500 hover:text-white
                        transition duration-300 rounded-full">
                    
                            Buy Now
                    
                        </button>
                    
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection