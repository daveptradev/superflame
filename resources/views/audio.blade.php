@extends('layouts.app')

@section('title', 'Audio - Superflame')

@section('content')

<!-- AUDIO LIST -->
<section class="px-4 md:px-6 pt-14 pb-20 bg-[#0a0a0a] min-h-[70vh]">

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
                       title="SoundCloud"
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
                       title="Bandcamp"
                       class="text-gray-500 hover:text-cyan-400 transition duration-300 hover:scale-110">
                
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-7 h-7">
                
                            <path d="M2 18L9.5 6H22l-7.5 12H2z"/>
                        </svg>
                
                    </a>
                
                </div>
                
                <!-- CATEGORY FILTER BUTTONS -->
                <div class="flex items-center justify-center gap-6 md:gap-8 mt-6 flex-wrap" id="audioCategoryFilters">
                
                    <button
                        onclick="filterAudio('ALL', this)"
                        class="category-btn text-sm md:text-base font-semibold tracking-[2px] text-white border-b-2 border-red-500 pb-2 transition">
                        ALL
                    </button>
                
                    <button
                        onclick="filterAudio('TRACKS', this)"
                        class="category-btn text-sm md:text-base font-semibold tracking-[2px] text-gray-500 hover:text-white transition pb-2">
                        TRACKS
                    </button>
                
                    <button
                        onclick="filterAudio('ALBUM', this)"
                        class="category-btn text-sm md:text-base font-semibold tracking-[2px] text-gray-500 hover:text-white transition pb-2">
                        ALBUM
                    </button>

                    <button
                        onclick="filterAudio('EDIT PACK', this)"
                        class="category-btn text-sm md:text-base font-semibold tracking-[2px] text-gray-500 hover:text-white transition pb-2">
                        EDIT PACK
                    </button>
                
                </div>

            </div>

        </div>

        <!-- GRID -->
        <div class="grid md:grid-cols-2 gap-8" id="audioGrid">

            @forelse($audios as $audio)
            <!-- CARD -->
            <div class="audio-card relative group bg-[#111] border border-white/5 rounded-3xl overflow-hidden hover:border-red-500/40 transition duration-500 flex flex-col justify-between"
                 data-category="{{ strtoupper($audio->category ?? 'TRACKS') }}">

                <!-- IMAGE / COVER -->
                <a href="{{ $audio->audio_url ?: ($audio->buy_url ?: '#') }}"
                   @if($audio->audio_url || $audio->buy_url) target="_blank" @endif
                   class="block relative overflow-hidden h-[320px] bg-[#181818]">

                    @if($audio->image)
                        <img src="{{ asset('storage/' . $audio->image) }}"
                             alt="{{ $audio->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition duration-500"></div>

                    @if($audio->category)
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-black/70 backdrop-blur border border-white/10 text-red-500 text-xs font-bold uppercase tracking-wider rounded-full">
                            {{ $audio->category }}
                        </span>
                    </div>
                    @endif

                </a>

                <!-- INFO -->
                <div class="p-7 flex-1 flex flex-col justify-between">

                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs tracking-[3px] uppercase text-red-500 font-semibold">
                                {{ $audio->artist ?: 'SUPERFLAME' }}
                            </span>
                            @if($audio->release_date)
                            <span class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($audio->release_date)->format('Y') }}
                            </span>
                            @endif
                        </div>

                        <h3 class="text-2xl font-extrabold text-white mb-3">
                            {{ $audio->title }}
                        </h3>

                        @if($audio->description)
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">
                            {{ $audio->description }}
                        </p>
                        @endif
                    </div>
                    
                    <!-- BUTTONS -->
                    <div class="flex items-center justify-end gap-3 mt-4">

                        @if($audio->audio_url)
                        <a href="{{ $audio->audio_url }}"
                           target="_blank"
                           class="px-4 py-2 border border-white/20 text-white
                           text-xs tracking-[2px] uppercase
                           hover:bg-white/10
                           transition duration-300 rounded-full flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            Listen
                        </a>
                        @endif

                        @if($audio->buy_url)
                        <a href="{{ $audio->buy_url }}"
                           target="_blank"
                           class="px-5 py-2 border border-red-500 text-red-500
                           text-xs tracking-[3px] uppercase
                           hover:bg-red-500 hover:text-white
                           transition duration-300 rounded-full">
                            {{ $audio->buy_label ?: 'Buy Now' }}
                        </a>
                        @endif

                    </div>

                </div>

            </div>
            @empty
            <!-- FALLBACK DEFAULT CARD IF DATABASE IS EMPTY -->
            <div class="audio-card relative group bg-[#111] border border-white/5 rounded-3xl overflow-hidden hover:border-red-500/40 transition duration-500"
                 data-category="EDIT PACK">

                <a href="https://soundcloud.com/superflame99/sets/supernova"
                   target="_blank"
                   class="block relative overflow-hidden">
                    <img src="{{ asset('storage/audio/supernova.png') }}"
                         onerror="this.src='{{ asset('assets/sflamered.png') }}'"
                         class="w-full h-[320px] object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-black/30"></div>
                </a>

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
                    
                    <div class="flex justify-end">
                        <button onclick="window.open('https://lynk.id/superflame', '_blank')"
                                class="px-5 py-2 border border-red-500 text-red-500 text-xs tracking-[3px] uppercase hover:bg-red-500 hover:text-white transition duration-300 rounded-full">
                            Buy Now
                        </button>
                    </div>
                </div>

            </div>
            @endforelse

        </div>

    </div>

</section>

<!-- CATEGORY FILTER SCRIPT -->
<script>
function filterAudio(category, btn) {
    // Update active tab buttons
    document.querySelectorAll('.category-btn').forEach(b => {
        b.classList.remove('text-white', 'border-b-2', 'border-red-500');
        b.classList.add('text-gray-500');
    });
    btn.classList.remove('text-gray-500');
    btn.classList.add('text-white', 'border-b-2', 'border-red-500');

    // Filter cards
    const cards = document.querySelectorAll('.audio-card');
    cards.forEach(card => {
        const cardCategory = card.getAttribute('data-category');
        if (category === 'ALL' || cardCategory === category) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

@endsection