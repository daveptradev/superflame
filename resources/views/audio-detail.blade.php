@extends('layouts.app')

@section('title', ($audio->title ?? 'Audio Detail') . ' - Superflame')

@section('content')

<!-- WAVESURFER.JS CDN -->
<script src="https://unpkg.com/wavesurfer.js@7"></script>

<!-- DETAIL CONTAINER -->
<section class="px-4 md:px-8 pt-10 pb-36 bg-[#0a0a0a] min-h-screen text-white">

    <div class="w-full max-w-[1400px] mx-auto">

        <!-- BREADCRUMB -->
        <div class="flex items-center gap-2 text-xs uppercase tracking-widest text-gray-500 mb-8">
            <a href="/" class="hover:text-red-500 transition">Home</a>
            <span>/</span>
            <a href="/audio" class="hover:text-red-500 transition">Audio</a>
            <span>/</span>
            <span class="text-red-500 font-semibold">{{ $audio->title }}</span>
        </div>

        <!-- HERO HEADER -->
        <div class="bg-[#111] border border-white/5 rounded-3xl p-6 md:p-10 mb-12 relative overflow-hidden">
            
            <!-- GLOW BACKGROUND -->
            <div class="absolute -right-20 -top-20 w-96 h-96 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="flex flex-col md:flex-row items-center md:items-start gap-8 relative z-10">

                <!-- ALBUM COVER -->
                <div class="w-64 h-64 md:w-80 md:h-80 flex-shrink-0 rounded-2xl overflow-hidden shadow-2xl shadow-black/80 border border-white/10 relative group">
                    @if($audio->image)
                        <img src="{{ asset('storage/' . $audio->image) }}"
                             alt="{{ $audio->title }}"
                             id="heroCoverImg"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-[#181818] text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition"></div>
                </div>

                <!-- INFO DETAILS -->
                <div class="flex-1 flex flex-col justify-between text-center md:text-left">
                    <div>
                        <!-- CATEGORY & DATE -->
                        <div class="flex items-center justify-center md:justify-start gap-3 mb-3">
                            <span class="px-3.5 py-1 bg-red-500/10 border border-red-500/30 text-red-500 text-xs font-bold uppercase tracking-[2px] rounded-full">
                                {{ $audio->category ?: 'EDIT PACK' }}
                            </span>
                            @if(!empty($audio->release_date))
                            <span class="text-xs text-gray-400 font-medium">
                                Released: {{ date('d M Y', strtotime($audio->release_date)) }}
                            </span>
                            @endif
                        </div>

                        <!-- TITLE -->
                        <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight mb-2">
                            {{ $audio->title }}
                        </h1>

                        <!-- ARTIST -->
                        <p class="text-sm font-semibold uppercase tracking-[3px] text-red-400 mb-5">
                            By {{ $audio->artist ?: 'SUPERFLAME' }}
                        </p>

                        <!-- DESCRIPTION -->
                        @if($audio->description)
                        <p class="text-gray-400 text-sm md:text-base leading-relaxed max-w-2xl mb-8">
                            {{ $audio->description }}
                        </p>
                        @endif
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="flex items-center justify-center md:justify-start gap-4 flex-wrap pt-2">
                        
                        @if(isset($audio->tracks) && $audio->tracks->count() > 0)
                        <button onclick="playTrack(0)"
                                class="bg-red-600 hover:bg-red-700 text-white px-7 py-3.5 rounded-full font-bold text-sm tracking-wider uppercase transition flex items-center gap-2.5 shadow-lg shadow-red-600/30 hover:scale-105 duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            Play Pack
                        </button>
                        @endif

                        @if($audio->buy_url)
                        <a href="{{ $audio->buy_url }}"
                           target="_blank"
                           class="border border-red-500 text-red-500 hover:bg-red-500 hover:text-white px-7 py-3.5 rounded-full font-bold text-sm tracking-wider uppercase transition duration-200">
                            {{ $audio->buy_label ?: 'Buy Now' }}
                        </a>
                        @endif

                        @if($audio->audio_url)
                        <a href="{{ $audio->audio_url }}"
                           target="_blank"
                           class="border border-white/20 text-gray-300 hover:text-white hover:bg-white/10 px-5 py-3.5 rounded-full font-semibold text-xs tracking-wider uppercase transition flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-500 fill-current" viewBox="0 0 24 24">
                                <path d="M17.812 10.04c-.294 0-.58.034-.854.098a4.85 4.85 0 00-4.556-3.23 4.84 4.84 0 00-1.964.41.45.45 0 00-.27.41v8.61a.45.45 0 00.45.45h7.194a3.374 3.374 0 000-6.748zM6.21 8.842a.45.45 0 00-.45.45v6.944a.45.45 0 10.9 0V9.292a.45.45 0 00-.45-.45zm-2.11 1.366a.45.45 0 00-.45.45v5.578a.45.45 0 10.9 0v-5.578a.45.45 0 00-.45-.45zm4.22-2.18a.45.45 0 00-.45.45v7.758a.45.45 0 10.9 0V8.478a.45.45 0 00-.45-.45z"/>
                            </svg>
                            SoundCloud
                        </a>
                        @endif

                    </div>

                </div>

            </div>

        </div>

        <!-- TRACKLIST SECTION -->
        <div class="mb-16">
            
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/10">
                <h2 class="text-xl md:text-2xl font-bold tracking-wide flex items-center gap-3">
                    <span>TRACKLIST</span>
                    <span class="text-xs bg-white/5 border border-white/10 px-3 py-1 rounded-full text-gray-400">
                        {{ isset($audio->tracks) ? $audio->tracks->count() : 0 }} Tracks
                    </span>
                </h2>
                <p class="text-xs text-gray-500">
                    Click any track to listen
                </p>
            </div>

            @if(isset($audio->tracks) && $audio->tracks->count() > 0)
            <div class="space-y-2" id="tracklistContainer">
                
                @foreach($audio->tracks as $index => $track)
                <div onclick="playTrack({{ $index }})"
                     id="trackRow-{{ $index }}"
                     class="track-row group flex items-center justify-between p-4 rounded-2xl bg-[#111]/80 hover:bg-[#181818] border border-white/5 hover:border-red-500/30 transition duration-200 cursor-pointer">
                    
                    <!-- LEFT: NUMBER & PLAY BUTTON & TITLE -->
                    <div class="flex items-center gap-4 min-w-0">
                        
                        <!-- INDEX / PLAY ICON -->
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-gray-500 group-hover:text-red-500">
                            <span class="track-number font-bold text-sm block group-hover:hidden">
                                {{ sprintf('%02d', $index + 1) }}
                            </span>
                            <svg class="track-play-icon w-5 h-5 hidden group-hover:block fill-current" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            <!-- EQUALIZER ANIMATION (ACTIVE WHEN PLAYING) -->
                            <div class="track-eq hidden items-end gap-0.5 h-4">
                                <span class="w-1 bg-red-500 rounded-full animate-[bounce_0.8s_infinite] h-3"></span>
                                <span class="w-1 bg-red-500 rounded-full animate-[bounce_1.1s_infinite] h-4"></span>
                                <span class="w-1 bg-red-500 rounded-full animate-[bounce_0.9s_infinite] h-2"></span>
                            </div>
                        </div>

                        <!-- TITLE & ARTIST -->
                        <div class="truncate">
                            <p class="track-title font-bold text-sm md:text-base text-white group-hover:text-red-400 transition truncate">
                                {{ $track->title }}
                            </p>
                            <p class="text-xs text-gray-500 truncate mt-0.5">
                                {{ $audio->artist ?: 'SUPERFLAME' }}
                            </p>
                        </div>

                    </div>

                    <!-- RIGHT: DURATION / STATUS -->
                    <div class="flex items-center gap-4 flex-shrink-0 pl-4">
                        <span class="text-xs font-semibold text-gray-500 group-hover:text-gray-300">
                            Stream
                        </span>
                        <div class="w-8 h-8 rounded-full bg-white/5 group-hover:bg-red-500 group-hover:text-white text-gray-400 flex items-center justify-center transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current ml-0.5" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                    </div>

                </div>
                @endforeach

            </div>
            @else
            <!-- EMPTY TRACKS NOTICE -->
            <div class="bg-[#111] border border-white/5 rounded-3xl p-12 text-center max-w-xl mx-auto my-8">
                <div class="w-16 h-16 mx-auto mb-4 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">Tracks Coming Soon</h3>
                <p class="text-gray-500 text-sm mb-6">No audio files have been attached to this pack yet.</p>
                @if($audio->audio_url)
                <a href="{{ $audio->audio_url }}"
                   target="_blank"
                   class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 px-6 py-3 rounded-full text-xs font-bold tracking-widest uppercase transition">
                    Listen on SoundCloud
                </a>
                @endif
            </div>
            @endif

        </div>

    </div>

</section>

<!-- ================================================================= -->
<!-- SOUNDCLOUD / SPOTIFY-STYLE DOCKED MINI PLAYER (INSTANT STREAMING) -->
<!-- ================================================================= -->
<div id="miniPlayer"
     class="fixed bottom-0 left-0 right-0 z-50 bg-[#080808]/95 backdrop-blur-2xl border-t border-white/10 shadow-2xl transition-all duration-500 transform translate-y-full">
    
    <div class="w-full max-w-[1400px] mx-auto px-4 md:px-8 py-3">
        
        <div class="flex flex-col md:flex-row items-center justify-between gap-3 md:gap-6">

            <!-- 1. LEFT: CURRENT TRACK INFO -->
            <div class="flex items-center gap-3.5 w-full md:w-1/4 min-w-0">
                <img id="playerCoverImg"
                     src="{{ $audio->image ? asset('storage/' . $audio->image) : asset('assets/sflamered.png') }}"
                     alt="Playing Cover"
                     class="w-12 h-12 rounded-xl object-cover border border-white/10 flex-shrink-0">
                <div class="min-w-0 flex-1">
                    <p id="playerTrackTitle" class="text-sm font-bold text-white truncate">
                        Select a track
                    </p>
                    <p id="playerArtist" class="text-xs text-red-500 font-medium truncate">
                        {{ $audio->artist ?: 'SUPERFLAME' }}
                    </p>
                </div>
            </div>

            <!-- 2. CENTER: CONTROLS & INSTANT WAVEFORM -->
            <div class="flex-1 w-full max-w-2xl flex flex-col items-center gap-1">
                
                <!-- TOP ROW: BUTTONS (PREV, PLAY/PAUSE, NEXT) & TIME -->
                <div class="flex items-center justify-between w-full">
                    <span id="currentTimeText" class="text-[11px] text-gray-400 font-mono w-12 text-left">00:00</span>

                    <div class="flex items-center gap-4">
                        <!-- PREVIOUS -->
                        <button onclick="prevTrack()"
                                class="text-gray-400 hover:text-white transition p-1 hover:scale-110"
                                title="Previous Track">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/>
                            </svg>
                        </button>

                        <!-- PLAY / PAUSE -->
                        <button id="playPauseBtn"
                                onclick="togglePlay()"
                                class="w-10 h-10 rounded-full bg-red-600 hover:bg-red-500 text-white flex items-center justify-center transition shadow-lg shadow-red-600/40 hover:scale-105"
                                title="Play/Pause">
                            <svg id="playIcon" class="w-4 h-4 ml-0.5 fill-current" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            <svg id="pauseIcon" class="w-4 h-4 hidden fill-current" viewBox="0 0 24 24">
                                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                            </svg>
                        </button>

                        <!-- NEXT -->
                        <button onclick="nextTrack()"
                                class="text-gray-400 hover:text-white transition p-1 hover:scale-110"
                                title="Next Track">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/>
                            </svg>
                        </button>
                    </div>

                    <span id="durationText" class="text-[11px] text-gray-400 font-mono w-12 text-right">00:00</span>
                </div>

                <!-- INSTANT SOUNDCLOUD AUDIO WAVEFORM CONTAINER -->
                <div class="w-full relative py-0.5">
                    <div id="waveform" class="w-full cursor-pointer overflow-hidden rounded-lg"></div>
                </div>

            </div>

            <!-- 3. RIGHT: VOLUME & BUY SHORTCUT -->
            <div class="hidden md:flex items-center justify-end gap-3 w-1/4">
                
                <!-- VOLUME BUTTON -->
                <button onclick="toggleMute()" class="text-gray-400 hover:text-white transition" title="Mute/Unmute">
                    <svg id="volumeIcon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                    </svg>
                </button>

                <!-- VOLUME SLIDER -->
                <input type="range"
                       id="volumeSlider"
                       min="0"
                       max="1"
                       step="0.05"
                       value="0.8"
                       oninput="setVolume(this.value)"
                       class="w-20 accent-red-600 h-1 bg-white/20 rounded-lg cursor-pointer">

                @if($audio->buy_url)
                <a href="{{ $audio->buy_url }}"
                   target="_blank"
                   class="ml-2 px-3 py-1.5 bg-red-600/20 text-red-400 hover:bg-red-600 hover:text-white border border-red-500/30 text-[10px] uppercase font-bold tracking-widest rounded-full transition">
                    Buy
                </a>
                @endif
            </div>

        </div>

    </div>

</div>

<!-- NATIVE STREAMING AUDIO ELEMENT FOR INSTANT PLAYBACK -->
<audio id="nativeAudioPlayer" preload="auto"></audio>

<!-- PLAYER JAVASCRIPT: INSTANT STREAMING + REALTIME WAVEFORM -->
<script>
const tracks = [
    @if(isset($audio->tracks))
        @foreach($audio->tracks as $t)
        {
            title: @json($t->title),
            src: "{{ asset('storage/' . $t->file_path) }}"
        },
        @endforeach
    @endif
];

let currentTrackIndex = -1;
let wavesurfer = null;

const nativePlayer = document.getElementById('nativeAudioPlayer');
const miniPlayer = document.getElementById('miniPlayer');
const playIcon = document.getElementById('playIcon');
const pauseIcon = document.getElementById('pauseIcon');
const playerTrackTitle = document.getElementById('playerTrackTitle');
const currentTimeText = document.getElementById('currentTimeText');
const durationText = document.getElementById('durationText');
const volumeSlider = document.getElementById('volumeSlider');

nativePlayer.volume = 0.8;

// Initialize WaveSurfer bound directly to native streaming audio element
function initWaveSurfer() {
    if (wavesurfer) return;

    wavesurfer = WaveSurfer.create({
        container: '#waveform',
        waveColor: 'rgba(255, 255, 255, 0.25)',
        progressColor: '#ef4444',
        cursorColor: '#ffffff',
        cursorWidth: 2,
        barWidth: 3,
        barGap: 2,
        barRadius: 2,
        height: 38,
        media: nativePlayer, // 🔥 Binds to streaming HTMLAudioElement (Plays immediately in <100ms!)
        normalize: true,
        responsive: true,
        fillParent: true,
    });

    wavesurfer.on('timeupdate', (currentTime) => {
        currentTimeText.innerText = formatTime(currentTime);
    });

    wavesurfer.on('seeking', (currentTime) => {
        currentTimeText.innerText = formatTime(currentTime);
    });

    wavesurfer.on('finish', () => {
        nextTrack();
    });

    wavesurfer.on('play', () => {
        updatePlayStateUI(true);
        updateActiveTrackRow();
    });

    wavesurfer.on('pause', () => {
        updatePlayStateUI(false);
        updateActiveTrackRow();
    });
}

function playTrack(index) {
    if (index < 0 || index >= tracks.length) return;

    currentTrackIndex = index;
    const track = tracks[currentTrackIndex];

    initWaveSurfer();

    playerTrackTitle.innerText = track.title;
    miniPlayer.classList.remove('translate-y-full');

    // 1. INSTANT PLAYBACK VIA STREAMING NATIVE AUDIO
    nativePlayer.src = track.src;
    nativePlayer.load();

    const playPromise = nativePlayer.play();
    if (playPromise !== undefined) {
        playPromise.then(() => {
            updatePlayStateUI(true);
            updateActiveTrackRow();
        }).catch(err => {
            console.warn('Playback notice:', err);
        });
    }

    updateActiveTrackRow();
}

function togglePlay() {
    if (currentTrackIndex === -1 && tracks.length > 0) {
        playTrack(0);
        return;
    }

    if (nativePlayer.paused) {
        nativePlayer.play();
        updatePlayStateUI(true);
    } else {
        nativePlayer.pause();
        updatePlayStateUI(false);
    }
    updateActiveTrackRow();
}

function prevTrack() {
    if (tracks.length === 0) return;
    let prevIndex = currentTrackIndex - 1;
    if (prevIndex < 0) prevIndex = tracks.length - 1;
    playTrack(prevIndex);
}

function nextTrack() {
    if (tracks.length === 0) return;
    let nextIndex = currentTrackIndex + 1;
    if (nextIndex >= tracks.length) nextIndex = 0;
    playTrack(nextIndex);
}

function updatePlayStateUI(isPlaying) {
    if (isPlaying) {
        playIcon.classList.add('hidden');
        pauseIcon.classList.remove('hidden');
    } else {
        playIcon.classList.remove('hidden');
        pauseIcon.classList.add('hidden');
    }
}

function updateActiveTrackRow() {
    document.querySelectorAll('.track-row').forEach((row, idx) => {
        const num = row.querySelector('.track-number');
        const eq = row.querySelector('.track-eq');
        const title = row.querySelector('.track-title');

        if (idx === currentTrackIndex) {
            row.classList.add('bg-red-500/10', 'border-red-500/40');
            title.classList.add('text-red-400');
            if (!nativePlayer.paused) {
                num.classList.add('hidden');
                eq.classList.remove('hidden');
                eq.classList.add('flex');
            } else {
                num.classList.remove('hidden');
                eq.classList.add('hidden');
                eq.classList.remove('flex');
            }
        } else {
            row.classList.remove('bg-red-500/10', 'border-red-500/40');
            title.classList.remove('text-red-400');
            num.classList.remove('hidden');
            eq.classList.add('hidden');
            eq.classList.remove('flex');
        }
    });
}

// Native Player events for duration and timeline
nativePlayer.addEventListener('loadedmetadata', () => {
    durationText.innerText = formatTime(nativePlayer.duration);
});

nativePlayer.addEventListener('durationchange', () => {
    durationText.innerText = formatTime(nativePlayer.duration);
});

nativePlayer.addEventListener('ended', () => {
    nextTrack();
});

function setVolume(val) {
    nativePlayer.volume = parseFloat(val);
}

function toggleMute() {
    nativePlayer.muted = !nativePlayer.muted;
    volumeSlider.value = nativePlayer.muted ? 0 : nativePlayer.volume;
}

function formatTime(seconds) {
    if (isNaN(seconds) || !isFinite(seconds)) return "00:00";
    const mins = Math.floor(seconds / 60);
    const secs = Math.floor(seconds % 60);
    return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

// Keyboard shortcuts (Space to toggle play/pause)
document.addEventListener('keydown', (e) => {
    if (e.code === 'Space' && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
        e.preventDefault();
        togglePlay();
    }
});
</script>

@endsection
