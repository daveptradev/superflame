@extends('layouts.admin')

@section('content')

<div class="max-w-4xl">

    <!-- TOP HEADER -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold">
                Edit Audio / Edit Pack
            </h1>
            <p class="text-gray-500 mt-1">
                Updating: <span class="text-red-400 font-semibold">{{ $audio->title }}</span>
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

    <form action="/admin/audios/{{ $audio->id }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        <!-- TITLE & ARTIST -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Title / Pack Name <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $audio->title) }}"
                       required
                       class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Artist / Creator
                </label>
                <input type="text"
                       name="artist"
                       value="{{ old('artist', $audio->artist) }}"
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
                    <option value="EDIT PACK" {{ old('category', $audio->category) == 'EDIT PACK' ? 'selected' : '' }}>EDIT PACK</option>
                    <option value="TRACKS" {{ old('category', $audio->category) == 'TRACKS' ? 'selected' : '' }}>TRACKS</option>
                    <option value="ALBUM" {{ old('category', $audio->category) == 'ALBUM' ? 'selected' : '' }}>ALBUM</option>
                    <option value="EP" {{ old('category', $audio->category) == 'EP' ? 'selected' : '' }}>EP</option>
                    <option value="REMIX" {{ old('category', $audio->category) == 'REMIX' ? 'selected' : '' }}>REMIX</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Release Date
                </label>
                <input type="date"
                       name="release_date"
                       value="{{ old('release_date', $audio->release_date) }}"
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
                       value="{{ old('audio_url', $audio->audio_url) }}"
                       placeholder="https://soundcloud.com/superflame99/sets/..."
                       class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">
                    Buy / External Link (Lynk.id / Bandcamp)
                </label>
                <input type="text"
                       name="buy_url"
                       value="{{ old('buy_url', $audio->buy_url) }}"
                       placeholder="https://lynk.id/superflame"
                       class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition">
            </div>
        </div>

        <!-- BUY BUTTON TEXT -->
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2">
                Button Label
            </label>
            <input type="text"
                   name="buy_label"
                   value="{{ old('buy_label', $audio->buy_label ?? 'Buy Now') }}"
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
                      class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition leading-relaxed">{{ old('description', $audio->description) }}</textarea>
        </div>

        <!-- COVER IMAGE -->
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2">
                Cover Image
            </label>

            @if($audio->image)
            <div class="mb-4 flex items-center gap-4 bg-[#161616] p-4 rounded-2xl border border-white/5">
                <img src="{{ asset('storage/' . $audio->image) }}"
                     alt="Current Cover"
                     class="w-20 h-20 object-cover rounded-xl border border-white/10">
                <div>
                    <p class="text-sm font-medium text-white">Current Cover Image</p>
                    <p class="text-xs text-gray-500 mt-0.5">Upload a new file below if you want to replace it.</p>
                </div>
            </div>
            @endif

            <input type="file"
                   name="image"
                   accept="image/*"
                   class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-red-600 file:text-white hover:file:bg-red-700 transition">
        </div>

        <!-- ============================================== -->
        <!-- EXISTING TRACKS LIST -->
        <!-- ============================================== -->
        <div class="pt-4 border-t border-white/10">
            <h3 class="text-lg font-bold text-white mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                </svg>
                Current Tracks ({{ $audio->tracks->count() }})
            </h3>

            @if($audio->tracks->count() > 0)
            <div class="space-y-3 mb-6">
                @foreach($audio->tracks as $index => $track)
                <div class="bg-[#161616] border border-white/10 rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <span class="w-7 h-7 rounded-lg bg-red-500/20 text-red-400 font-bold text-xs flex items-center justify-center flex-shrink-0">
                            {{ $track->track_number ?? ($index + 1) }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <input type="text"
                                   name="existing_track_titles[{{ $track->id }}]"
                                   value="{{ $track->title }}"
                                   class="bg-[#0f0f0f] border border-white/10 rounded-xl px-3 py-2 text-sm text-white w-full md:w-64 focus:outline-none focus:border-red-500 transition">
                            <p class="text-[11px] text-gray-500 mt-1 truncate">
                                {{ $track->file_path }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                        <audio controls src="{{ asset('storage/' . $track->file_path) }}" class="h-8 max-w-[200px]"></audio>

                        <button type="button"
                                onclick="deleteTrackAjax('{{ $track->id }}', this)"
                                class="p-2 rounded-xl bg-red-500/10 hover:bg-red-500/20 text-red-400 transition"
                                title="Delete this track">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-xs text-gray-500 mb-4 italic">No tracks uploaded yet for this pack.</p>
            @endif

            <!-- DRAG & DROP ADD NEW TRACKS -->
            <div class="mt-4">
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-sm font-semibold text-gray-300">
                        Add More Tracks (Drag & Drop)
                    </label>
                    <span id="trackCountBadge" class="hidden text-xs bg-red-500/20 text-red-400 font-bold px-3 py-1 rounded-full border border-red-500/30">
                        0 New Tracks
                    </span>
                </div>

                <div id="dropZone"
                     class="relative border-2 border-dashed border-white/20 hover:border-red-500/60 bg-[#111] hover:bg-red-950/10 rounded-3xl p-6 text-center cursor-pointer transition duration-300">
                    
                    <input type="file"
                           id="audioFileInput"
                           name="tracks[]"
                           multiple
                           accept="audio/*,.mp3,.wav,.ogg,.m4a,.flac,.aac"
                           class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">

                    <div class="flex flex-col items-center pointer-events-none">
                        <div class="w-12 h-12 rounded-full bg-red-500/10 text-red-500 flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-white">
                            Drag & Drop new songs here to append
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            or <span class="text-red-400 underline">browse files</span>
                        </p>
                    </div>
                </div>

                <!-- NEW TRACKS PREVIEW LIST -->
                <div id="tracksList" class="mt-4 space-y-3"></div>
            </div>
        </div>

        <!-- SUBMIT -->
        <div class="pt-6 flex items-center gap-4">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 px-8 py-4 rounded-2xl font-semibold transition inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Update Audio & Tracks
            </button>

            <a href="/admin/audios"
               class="bg-white/5 hover:bg-white/10 px-8 py-4 rounded-2xl font-semibold transition">
                Cancel
            </a>
        </div>

    </form>

</div>

<!-- HIDDEN DELETE TRACK FORM -->
<form id="deleteTrackForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
function deleteTrackAjax(trackId, btn) {
    if (confirm('Are you sure you want to delete this track?')) {
        const form = document.getElementById('deleteTrackForm');
        form.action = '/admin/audios/track/' + trackId;
        form.submit();
    }
}

// Drag & Drop logic
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
        trackCountBadge.innerText = `${selectedFiles.length} New Track${selectedFiles.length > 1 ? 's' : ''} Selected`;
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
                <span class="w-7 h-7 rounded-lg bg-green-500/20 text-green-400 font-bold text-xs flex items-center justify-center flex-shrink-0">
                    +${index + 1}
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
