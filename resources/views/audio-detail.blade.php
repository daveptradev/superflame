@extends('layouts.app')

@section('title', ($audio->title ?? 'Audio Detail') . ' - Superflame')

@section('content')

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

                    <!-- RIGHT: FREE DOWNLOAD BUTTON (IF ALLOWED) -->
                    <div class="flex items-center gap-3 flex-shrink-0 pl-3">
                        @if($track->allow_download ?? true)
                        <a href="{{ asset('storage/' . $track->file_path) }}"
                           download="{{ $track->title }}"
                           onclick="event.stopPropagation()"
                           title="Download {{ $track->title }}"
                           class="px-4 py-2 bg-white/5 hover:bg-red-600 border border-white/10 hover:border-red-500 text-gray-300 hover:text-white rounded-full text-xs font-bold tracking-wider uppercase transition duration-300 flex items-center gap-2 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <span class="hidden sm:inline">Free Download</span>
                            <span class="sm:hidden">Download</span>
                        </a>
                        @endif
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
<!-- SOUNDCLOUD REAL CANVAS WAVEFORM MINI PLAYER (ACCURATE 1:1 HOVER) -->
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

            <!-- 2. CENTER: CONTROLS & SOUNDCLOUD CANVAS WAVEFORM -->
            <div class="flex-1 w-full max-w-2xl flex flex-col items-center gap-1.5">
                
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

                <!-- REAL SOUNDCLOUD CANVAS WAVEFORM CONTAINER -->
                <div id="waveformWrapper" class="w-full relative group py-0.5">
                    <!-- FLOATING TIMESTAMP TOOLTIP ON HOVER -->
                    <div id="hoverTooltip"
                         class="opacity-0 pointer-events-none absolute -top-6 bg-red-600 text-white text-[10px] font-mono font-bold px-2 py-0.5 rounded shadow-lg transition-opacity duration-150 transform -translate-x-1/2 z-20">
                        00:00
                    </div>

                    <!-- HOVER INDICATOR LINE -->
                    <div id="hoverLine"
                         class="opacity-0 pointer-events-none absolute top-0 bottom-0 w-[1px] bg-white/60 transition-opacity duration-150 z-10"></div>

                    <canvas id="waveformCanvas"
                            class="w-full h-11 cursor-pointer rounded-lg block"
                            height="44"></canvas>
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

<!-- NATIVE AUDIO ELEMENT -->
<audio id="nativeAudioPlayer" preload="auto"></audio>

<!-- SOUNDCLOUD REAL CANVAS WAVEFORM ENGINE -->
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

const NUM_BARS = 120;
const peaksCache = {}; // In-memory cache for true decoded waveform peaks
let currentTrackIndex = -1;
let waveformPeaks = [];
let hoverProgress = -1;
let audioCtx = null;
let animFrameId = null;

const nativePlayer = document.getElementById('nativeAudioPlayer');
const miniPlayer = document.getElementById('miniPlayer');
const playIcon = document.getElementById('playIcon');
const pauseIcon = document.getElementById('pauseIcon');
const playerTrackTitle = document.getElementById('playerTrackTitle');
const currentTimeText = document.getElementById('currentTimeText');
const durationText = document.getElementById('durationText');
const volumeSlider = document.getElementById('volumeSlider');
const waveformCanvas = document.getElementById('waveformCanvas');
const waveformWrapper = document.getElementById('waveformWrapper');
const hoverTooltip = document.getElementById('hoverTooltip');
const hoverLine = document.getElementById('hoverLine');
const ctx = waveformCanvas.getContext('2d');

nativePlayer.volume = 0.8;

// FAST PRE-DECODE TRUE PEAKS FOR ALL TRACKS ON PAGE LOAD
function predecodeAllTracks() {
    tracks.forEach((t) => {
        decodeTrackPeaks(t.src);
    });
}

// EXTRACT TRUE RMS & PEAK AMPLITUDES FROM AUDIO BUFFER
function decodeTrackPeaks(src) {
    if (peaksCache[src]) return Promise.resolve(peaksCache[src]);

    return fetch(src)
        .then(res => res.arrayBuffer())
        .then(arrayBuffer => {
            if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
            return audioCtx.decodeAudioData(arrayBuffer);
        })
        .then(audioBuffer => {
            const rawData = audioBuffer.getChannelData(0);
            const step = Math.floor(rawData.length / NUM_BARS);
            const realPeaks = [];
            
            for (let i = 0; i < NUM_BARS; i++) {
                let sum = 0;
                let peak = 0;
                const offset = i * step;
                for (let j = 0; j < step; j += 4) { // Fast 4x sample skip
                    const val = Math.abs(rawData[offset + j]);
                    sum += val * val;
                    if (val > peak) peak = val;
                }
                const rms = Math.sqrt(sum / (step / 4));
                realPeaks.push((rms * 0.7) + (peak * 0.3));
            }

            // Normalize peaks so dynamic range matches real track energy
            const maxVal = Math.max(...realPeaks, 0.05);
            const normalized = realPeaks.map(p => Math.max(0.1, Math.min(0.95, (p / maxVal))));

            peaksCache[src] = normalized;
            return normalized;
        })
        .catch(err => {
            return null;
        });
}

// SETUP WAVEFORM FOR SELECTED TRACK
function setupWaveformForTrack(src) {
    if (peaksCache[src]) {
        // True waveform is already in memory -> ZERO delay, exact shape!
        waveformPeaks = [...peaksCache[src]];
        drawWaveform();
    } else {
        // Initial flat clean waveform while decode completes
        waveformPeaks = Array.from({ length: NUM_BARS }, () => 0.25);
        drawWaveform();

        decodeTrackPeaks(src).then(realPeaks => {
            if (realPeaks && currentTrackIndex >= 0 && tracks[currentTrackIndex].src === src) {
                waveformPeaks = [...realPeaks];
                drawWaveform();
            }
        });
    }
}

// DRAW SOUNDCLOUD DUAL-TONE CANVAS WAVEFORM (100% PRECISE 1:1 FIT)
function drawWaveform() {
    const width = waveformCanvas.clientWidth || 600;
    const height = waveformCanvas.height || 44;
    
    if (waveformCanvas.width !== width) {
        waveformCanvas.width = width;
    }

    ctx.clearRect(0, 0, width, height);

    const totalBars = waveformPeaks.length || NUM_BARS;
    const slotWidth = width / totalBars;
    const barWidth = Math.max(1.8, slotWidth * 0.62);

    const currentProgress = (nativePlayer.duration && nativePlayer.duration > 0)
        ? (nativePlayer.currentTime / nativePlayer.duration)
        : 0;

    for (let i = 0; i < totalBars; i++) {
        const barHeight = Math.max(4, (waveformPeaks[i] || 0.2) * (height - 8));
        const x = i * slotWidth;
        const y = (height - barHeight) / 2;
        const barProgress = (i + 0.5) / totalBars;

        // Soundcloud Color
        if (barProgress <= currentProgress) {
            ctx.fillStyle = '#ef4444'; // Played: Red
        } else if (hoverProgress >= 0 && barProgress <= hoverProgress) {
            ctx.fillStyle = 'rgba(239, 68, 68, 0.45)'; // Hover Preview
        } else {
            ctx.fillStyle = 'rgba(255, 255, 255, 0.25)'; // Unplayed: Translucent White
        }

        // Draw Rounded Bar
        ctx.beginPath();
        if (ctx.roundRect) {
            ctx.roundRect(x, y, barWidth, barHeight, 1.5);
        } else {
            ctx.rect(x, y, barWidth, barHeight);
        }
        ctx.fill();
    }

    // Draw White Needle Playhead Cursor
    const cursorX = currentProgress * width;
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(Math.max(0, cursorX - 1), 2, 2, height - 4);

    // Needle Top Dot
    ctx.beginPath();
    ctx.arc(cursorX, 4, 3, 0, Math.PI * 2);
    ctx.fillStyle = '#ef4444';
    ctx.fill();
    ctx.strokeStyle = '#ffffff';
    ctx.lineWidth = 1;
    ctx.stroke();
}

// PLAY TRACK (INSTANT STREAMING)
function playTrack(index) {
    if (index < 0 || index >= tracks.length) return;

    currentTrackIndex = index;
    const track = tracks[currentTrackIndex];

    playerTrackTitle.innerText = track.title;
    miniPlayer.classList.remove('translate-y-full');

    setupWaveformForTrack(track.src);

    nativePlayer.src = track.src;
    nativePlayer.load();

    const playPromise = nativePlayer.play();
    if (playPromise !== undefined) {
        playPromise.then(() => {
            updatePlayStateUI(true);
            updateActiveTrackRow();
        }).catch(err => {
            console.warn('Play notice:', err);
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

// PRECISE 1:1 TIMELINE SEEKING & HOVER TOOLTIP
function getProgressFromEvent(e) {
    const rect = waveformCanvas.getBoundingClientRect();
    const clickX = e.clientX - rect.left;
    return Math.max(0, Math.min(1, clickX / rect.width));
}

waveformCanvas.addEventListener('click', (e) => {
    const progress = getProgressFromEvent(e);
    if (nativePlayer.duration && isFinite(nativePlayer.duration)) {
        nativePlayer.currentTime = progress * nativePlayer.duration;
        drawWaveform();
    }
});

waveformCanvas.addEventListener('mousemove', (e) => {
    const rect = waveformCanvas.getBoundingClientRect();
    const mouseX = Math.max(0, Math.min(rect.width, e.clientX - rect.left));
    hoverProgress = mouseX / rect.width;
    
    // Position hover line & tooltip exactly on hovered bar
    hoverLine.style.left = `${mouseX}px`;
    hoverLine.classList.remove('opacity-0');

    hoverTooltip.style.left = `${mouseX}px`;
    hoverTooltip.classList.remove('opacity-0');

    if (nativePlayer.duration && isFinite(nativePlayer.duration)) {
        const hoverTime = hoverProgress * nativePlayer.duration;
        hoverTooltip.innerText = formatTime(hoverTime);
    } else {
        hoverTooltip.innerText = "00:00";
    }

    drawWaveform();
});

waveformCanvas.addEventListener('mouseleave', () => {
    hoverProgress = -1;
    hoverLine.classList.add('opacity-0');
    hoverTooltip.classList.add('opacity-0');
    drawWaveform();
});

// NATIVE PLAYER TIMEUPDATE & EVENTS
nativePlayer.addEventListener('timeupdate', () => {
    currentTimeText.innerText = formatTime(nativePlayer.currentTime);
    drawWaveform();
});

nativePlayer.addEventListener('loadedmetadata', () => {
    durationText.innerText = formatTime(nativePlayer.duration);
    drawWaveform();
});

nativePlayer.addEventListener('durationchange', () => {
    durationText.innerText = formatTime(nativePlayer.duration);
    drawWaveform();
});

nativePlayer.addEventListener('ended', () => {
    nextTrack();
});

nativePlayer.addEventListener('play', () => {
    updatePlayStateUI(true);
    updateActiveTrackRow();
});

nativePlayer.addEventListener('pause', () => {
    updatePlayStateUI(false);
    updateActiveTrackRow();
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

// Window resize redraw
window.addEventListener('resize', () => {
    drawWaveform();
});

// Trigger pre-decoding when page loads so waveforms are instant
window.addEventListener('DOMContentLoaded', () => {
    predecodeAllTracks();
});

// Keyboard shortcuts (Space to toggle play/pause)
document.addEventListener('keydown', (e) => {
    if (e.code === 'Space' && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
        e.preventDefault();
        togglePlay();
    }
});
</script>

@endsection
