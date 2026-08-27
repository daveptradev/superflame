@extends('layouts.admin')

@section('content')

<div class="max-w-4xl">

    <!-- TOP HEADER -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold">
                Add Audio / Edit Pack
            </h1>
            <p class="text-gray-500 mt-1">
                Upload release info & drag & drop multiple audio tracks
            </p>
        </div>

        <a href="/admin/audios"
           class="bg-white/5 hover:bg-white/10 px-5 py-2.5 rounded-2xl text-sm font-medium transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>

    <!-- ERROR MESSAGES -->
    @if ($errors->any())
    <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 p-5 rounded-2xl">
        <p class="font-bold mb-2">Please fix the following errors:</p>
        <ul class="list-disc list-inside space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="/admin/audios"
          method="POST"
          enctype="multipart/form-data"
          id="audioForm"
          class="space-y-6">

        @csrf

        <!-- TITLE & ARTIST -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Title / Pack Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       placeholder="e.g. SUPERNOVA EDIT PACK"
                       required
                       class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Artist / Creator
                </label>
                <input type="text"
                       name="artist"
                       value="{{ old('artist', 'SUPERFLAME') }}"
                       placeholder="e.g. SUPERFLAME"
                       class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
            </div>
        </div>

        <!-- CATEGORY & RELEASE DATE -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Category
                </label>
                <select name="category"
                        class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
                    <option value="EDIT PACK" {{ old('category') == 'EDIT PACK' ? 'selected' : '' }}>EDIT PACK</option>
                    <option value="TRACKS" {{ old('category') == 'TRACKS' ? 'selected' : '' }}>TRACKS</option>
                    <option value="ALBUM" {{ old('category') == 'ALBUM' ? 'selected' : '' }}>ALBUM</option>
                    <option value="EP" {{ old('category') == 'EP' ? 'selected' : '' }}>EP</option>
                    <option value="REMIX" {{ old('category') == 'REMIX' ? 'selected' : '' }}>REMIX</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Release Date
                </label>
                <input type="date"
                       name="release_date"
                       value="{{ old('release_date', date('Y-m-d')) }}"
                       class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
            </div>
        </div>

        <!-- STREAM URL & BUY / EXTERNAL LINK -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    SoundCloud / Stream URL
                </label>
                <input type="text"
                       name="audio_url"
                       value="{{ old('audio_url') }}"
                       placeholder="https://soundcloud.com/superflame99/sets/..."
                       class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Buy / External Link (Lynk.id / Bandcamp)
                </label>
                <input type="text"
                       name="buy_url"
                       value="{{ old('buy_url') }}"
                       placeholder="https://lynk.id/superflame"
                       class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
            </div>
        </div>

        <!-- BUY BUTTON TEXT -->
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2">
                Button Label (Default: Buy Now)
            </label>
            <input type="text"
                   name="buy_label"
                   value="{{ old('buy_label', 'Buy Now') }}"
                   placeholder="Buy Now / Free Download / Listen"
                   class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
        </div>

        <!-- DESCRIPTION -->
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2">
                Description
            </label>
            <textarea name="description"
                      rows="3"
                      placeholder="Brief description about this release..."
                      class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition leading-relaxed">{{ old('description') }}</textarea>
        </div>

        <!-- COVER IMAGE -->
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2">
                Cover Image <span class="text-red-500">*</span>
            </label>
            <input type="file"
                   name="image"
                   accept="image/*"
                   required
                   class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-600 file:text-white hover:file:bg-red-700 transition">
        </div>

        <!-- ============================================== -->
        <!-- DRAG & DROP MULTI-AUDIO UPLOAD SECTION -->
        <!-- ============================================== -->
        <div class="pt-4 border-t border-white/10">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                        Upload Audio Tracks (Multiple MP3 / WAV)
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5">
                        Drag and drop all songs for this edit pack so users can stream them in the miniplayer.
                    </p>
                </div>
                <span id="trackCountBadge" class="hidden text-xs bg-red-500/20 text-red-400 font-bold px-3 py-1 rounded-full border border-red-500/30">
                    0 Tracks Selected
                </span>
            </div>

            <!-- DRAG & DROP ZONE -->
            <div id="dropZone"
                 class="relative border-2 border-dashed border-white/20 hover:border-red-500/60 bg-[#111] hover:bg-red-950/10 rounded-3xl p-8 text-center cursor-pointer transition duration-300">
                
                <input type="file"
                       id="audioFileInput"
                       name="tracks[]"
                       multiple
                       accept="audio/*,.mp3,.wav,.ogg,.m4a,.flac,.aac"
                       class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">

                <div class="flex flex-col items-center pointer-events-none">
                    <div class="w-16 h-16 rounded-full bg-red-500/10 text-red-500 flex items-center justify-center mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <p class="text-base font-bold text-white">
                        Drag & Drop audio files here
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        or <span class="text-red-400 underline">browse from your computer</span> (supports multiple .mp3, .wav, .m4a)
                    </p>
                </div>
            </div>

            <!-- TRACKS PREVIEW LIST -->
            <div id="tracksList" class="mt-4 space-y-3"></div>
        </div>

        <!-- SUBMIT -->
        <div class="pt-6">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 px-10 py-4 rounded-2xl font-bold text-white transition inline-flex items-center gap-2 shadow-lg shadow-red-600/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Audio & Tracks
            </button>
        </div>

    </form>

</div>

<!-- DRAG & DROP SCRIPT -->
<script>
const dropZone = document.getElementById('dropZone');
const audioFileInput = document.getElementById('audioFileInput');
const tracksList = document.getElementById('tracksList');
const trackCountBadge = document.getElementById('trackCountBadge');

let selectedFiles = [];

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.add('border-red-500', 'bg-red-500/10');
    });
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropZone.classList.remove('border-red-500', 'bg-red-500/10');
    });
});

audioFileInput.addEventListener('change', function(e) {
    handleFiles(Array.from(this.files));
});

dropZone.addEventListener('drop', function(e) {
    const dt = e.dataTransfer;
    if (dt && dt.files.length) {
        handleFiles(Array.from(dt.files));
    }
});

function handleFiles(files) {
    files.forEach(file => {
        if (file.type.startsWith('audio/') || file.name.match(/\.(mp3|wav|ogg|m4a|flac|aac)$/i)) {
            selectedFiles.push(file);
        }
    });
    renderTracksList();
    syncInputFiles();
}

function removeTrack(index) {
    selectedFiles.splice(index, 1);
    renderTracksList();
    syncInputFiles();
}

function syncInputFiles() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    audioFileInput.files = dataTransfer.files;

    if (selectedFiles.length > 0) {
        trackCountBadge.classList.remove('hidden');
        trackCountBadge.innerText = `${selectedFiles.length} Track${selectedFiles.length > 1 ? 's' : ''} Selected`;
    } else {
        trackCountBadge.classList.add('hidden');
    }
}

function renderTracksList() {
    tracksList.innerHTML = '';
    selectedFiles.forEach((file, index) => {
        const cleanName = file.name.replace(/\.[^/.]+$/, "").replace(/^[\d\s_\-\.]+/, "");
        const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
        const objectUrl = URL.createObjectURL(file);

        const card = document.createElement('div');
        card.className = 'bg-[#161616] border border-white/10 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 transition hover:border-red-500/30';
        card.innerHTML = `
            <div class="flex items-center gap-3 w-full md:w-auto">
                <span class="w-7 h-7 rounded-lg bg-red-500/20 text-red-400 font-bold text-xs flex items-center justify-center flex-shrink-0">
                    ${index + 1}
                </span>
                <div class="flex-1 min-w-0">
                    <input type="text"
                           name="track_titles[${index}]"
                           value="${cleanName}"
                           placeholder="Track Title"
                           class="bg-[#0f0f0f] border border-white/10 rounded-xl px-3 py-2 text-sm text-white w-full md:w-64 focus:outline-none focus:border-red-500 transition">
                    <p class="text-[11px] text-gray-500 mt-1 truncate">
                        ${file.name} • <span class="text-gray-400">${fileSizeMB} MB</span>
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                <audio controls src="${objectUrl}" class="h-8 max-w-[200px]"></audio>
                <button type="button"
                        onclick="removeTrack(${index})"
                        class="p-2 rounded-xl bg-red-500/10 hover:bg-red-500/20 text-red-400 transition"
                        title="Remove track">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        `;
        tracksList.appendChild(card);
    });
}
</script>

@endsection
