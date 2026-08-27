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

    <div id="jsErrorAlert" class="hidden mb-6 bg-red-500/10 border border-red-500/20 text-red-400 p-5 rounded-2xl">
        <p class="font-bold mb-1" id="jsErrorMessage"></p>
    </div>

    <form action="/admin/audios/{{ $audio->id }}"
          method="POST"
          enctype="multipart/form-data"
          id="audioForm"
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
                <div id="trackRowCard-{{ $track->id }}"
                     class="bg-[#161616] border {{ $track->is_active ?? true ? 'border-white/10' : 'border-red-500/20 opacity-60' }} rounded-2xl p-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 transition duration-200">
                    
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <span class="w-7 h-7 rounded-lg {{ $track->is_active ?? true ? 'bg-red-500/20 text-red-400' : 'bg-gray-700 text-gray-400' }} font-bold text-xs flex items-center justify-center flex-shrink-0">
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
                        <audio controls src="{{ asset('storage/' . $track->file_path) }}" class="h-8 max-w-[180px]"></audio>

                        <!-- TRACK VISIBILITY ON / OFF TOGGLE -->
                        <div class="flex items-center">
                            <button type="button"
                                    id="toggleBtn-{{ $track->id }}"
                                    onclick="toggleTrackStatusAjax('{{ $track->id }}')"
                                    class="px-2.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 border {{ $track->is_active ?? true ? 'bg-green-500/10 border-green-500/30 text-green-400 hover:bg-green-500/20' : 'bg-gray-800 border-white/10 text-gray-400 hover:bg-gray-700' }}"
                                    title="Toggle track visibility on user page">
                                <span id="toggleDot-{{ $track->id }}" class="w-2 h-2 rounded-full {{ $track->is_active ?? true ? 'bg-green-500 animate-pulse' : 'bg-gray-500' }}"></span>
                                <span id="toggleText-{{ $track->id }}">{{ $track->is_active ?? true ? 'Track ON' : 'Track OFF' }}</span>
                            </button>
                            <input type="checkbox"
                                   name="existing_track_active[{{ $track->id }}]"
                                   id="trackActiveCheckbox-{{ $track->id }}"
                                   value="1"
                                   class="hidden"
                                   {{ $track->is_active ?? true ? 'checked' : '' }}>
                        </div>

                        <!-- DOWNLOAD BUTTON ON / OFF TOGGLE -->
                        <div class="flex items-center">
                            <button type="button"
                                    id="downloadToggleBtn-{{ $track->id }}"
                                    onclick="toggleTrackDownloadAjax('{{ $track->id }}')"
                                    class="px-2.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 border {{ $track->allow_download ?? true ? 'bg-blue-500/10 border-blue-500/30 text-blue-400 hover:bg-blue-500/20' : 'bg-gray-800 border-white/10 text-gray-400 hover:bg-gray-700' }}"
                                    title="Toggle Free Download button on user page">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                <span id="downloadToggleText-{{ $track->id }}">{{ $track->allow_download ?? true ? 'Download ON' : 'Download OFF' }}</span>
                            </button>
                            <input type="checkbox"
                                   name="existing_track_download[{{ $track->id }}]"
                                   id="trackDownloadCheckbox-{{ $track->id }}"
                                   value="1"
                                   class="hidden"
                                   {{ $track->allow_download ?? true ? 'checked' : '' }}>
                        </div>

                        <!-- DELETE BUTTON -->
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

        <!-- SUBMIT BUTTON -->
        <div class="pt-6 flex items-center gap-4">
            <button type="submit"
                    id="submitBtn"
                    class="bg-red-600 hover:bg-red-700 px-8 py-4 rounded-2xl font-semibold transition inline-flex items-center gap-2 shadow-lg shadow-red-600/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Update Audio & Tracks</span>
            </button>

            <a href="/admin/audios"
               class="bg-white/5 hover:bg-white/10 px-8 py-4 rounded-2xl font-semibold transition">
                Cancel
            </a>
        </div>

    </form>

</div>

<!-- ============================================== -->
<!-- FULLSCREEN UPLOAD PROGRESS OVERLAY MODAL -->
<!-- ============================================== -->
<div id="uploadModal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="bg-[#121212] border border-white/10 rounded-3xl p-8 max-w-md w-full text-center shadow-2xl relative overflow-hidden">
        
        <!-- GLOW -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-red-600/20 rounded-full blur-3xl"></div>

        <!-- SPINNER / ICON -->
        <div class="w-20 h-20 mx-auto mb-5 relative flex items-center justify-center">
            <div class="w-20 h-20 rounded-full border-4 border-white/10 border-t-red-600 animate-spin absolute inset-0"></div>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-red-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
            </svg>
        </div>

        <h3 id="uploadStatusTitle" class="text-xl font-bold text-white mb-1">
            Updating Audio & Uploading Tracks...
        </h3>
        <p id="uploadStatusSubtitle" class="text-xs text-gray-400 mb-6">
            Please wait while your files are being uploaded to the server. Do not close this window.
        </p>

        <!-- PROGRESS BAR -->
        <div class="w-full bg-white/10 h-3 rounded-full overflow-hidden mb-3 p-0.5">
            <div id="uploadProgressBar" class="bg-gradient-to-r from-red-600 to-orange-500 h-full rounded-full w-0 transition-all duration-200"></div>
        </div>

        <!-- PERCENTAGE & SPEED -->
        <div class="flex items-center justify-between text-xs font-mono">
            <span id="uploadPercentText" class="text-red-400 font-bold">0%</span>
            <span id="uploadSizeText" class="text-gray-400">0 MB / 0 MB</span>
        </div>

    </div>
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

function toggleTrackStatusAjax(trackId) {
    const btn = document.getElementById('toggleBtn-' + trackId);
    const dot = document.getElementById('toggleDot-' + trackId);
    const text = document.getElementById('toggleText-' + trackId);
    const checkbox = document.getElementById('trackActiveCheckbox-' + trackId);
    const card = document.getElementById('trackRowCard-' + trackId);

    // Optimistic UI toggle
    btn.disabled = true;

    fetch('/admin/audios/track/' + trackId + '/toggle', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        if (data.success) {
            const isActive = data.is_active;
            checkbox.checked = isActive;
            
            if (isActive) {
                btn.className = 'px-2.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 border bg-green-500/10 border-green-500/30 text-green-400 hover:bg-green-500/20';
                dot.className = 'w-2 h-2 rounded-full bg-green-500 animate-pulse';
                text.innerText = 'Track ON';
                card.classList.remove('border-red-500/20', 'opacity-60');
                card.classList.add('border-white/10');
            } else {
                btn.className = 'px-2.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 border bg-gray-800 border-white/10 text-gray-400 hover:bg-gray-700';
                dot.className = 'w-2 h-2 rounded-full bg-gray-500';
                text.innerText = 'Track OFF';
                card.classList.remove('border-white/10');
                card.classList.add('border-red-500/20', 'opacity-60');
            }
        }
    })
    .catch(err => {
        btn.disabled = false;
        alert('Failed to toggle track status. Please try again.');
    });
}

function toggleTrackDownloadAjax(trackId) {
    const btn = document.getElementById('downloadToggleBtn-' + trackId);
    const text = document.getElementById('downloadToggleText-' + trackId);
    const checkbox = document.getElementById('trackDownloadCheckbox-' + trackId);

    btn.disabled = true;

    fetch('/admin/audios/track/' + trackId + '/toggle-download', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        if (data.success) {
            const isDownloadAllowed = data.allow_download;
            checkbox.checked = isDownloadAllowed;

            if (isDownloadAllowed) {
                btn.className = 'px-2.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 border bg-blue-500/10 border-blue-500/30 text-blue-400 hover:bg-blue-500/20';
                text.innerText = 'Download ON';
            } else {
                btn.className = 'px-2.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 border bg-gray-800 border-white/10 text-gray-400 hover:bg-gray-700';
                text.innerText = 'Download OFF';
            }
        }
    })
    .catch(err => {
        btn.disabled = false;
        alert('Failed to toggle download status. Please try again.');
    });
}

// Drag & Drop logic
const dropZone = document.getElementById('dropZone');
const audioFileInput = document.getElementById('audioFileInput');
const tracksList = document.getElementById('tracksList');
const trackCountBadge = document.getElementById('trackCountBadge');
const audioForm = document.getElementById('audioForm');
const submitBtn = document.getElementById('submitBtn');

const uploadModal = document.getElementById('uploadModal');
const uploadProgressBar = document.getElementById('uploadProgressBar');
const uploadPercentText = document.getElementById('uploadPercentText');
const uploadSizeText = document.getElementById('uploadSizeText');
const uploadStatusTitle = document.getElementById('uploadStatusTitle');
const uploadStatusSubtitle = document.getElementById('uploadStatusSubtitle');

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

// REAL AJAX FORM SUBMIT WITH PROGRESS BAR
audioForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(audioForm);
    
    // Show Modal
    uploadModal.classList.remove('hidden');
    uploadModal.classList.add('flex');
    submitBtn.disabled = true;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', audioForm.action, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.upload.onprogress = function(event) {
        if (event.lengthComputable) {
            const percentComplete = Math.round((event.loaded / event.total) * 100);
            const loadedMB = (event.loaded / (1024 * 1024)).toFixed(1);
            const totalMB = (event.total / (1024 * 1024)).toFixed(1);

            uploadProgressBar.style.width = percentComplete + '%';
            uploadPercentText.innerText = percentComplete + '%';
            uploadSizeText.innerText = `${loadedMB} MB / ${totalMB} MB`;

            if (percentComplete >= 100) {
                uploadStatusTitle.innerText = 'Processing & Saving Files...';
                uploadStatusSubtitle.innerText = 'Finishing up on the server. Please hold on a moment...';
            }
        }
    };

    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            uploadStatusTitle.innerText = 'Update Complete!';
            uploadPercentText.innerText = '100%';
            uploadProgressBar.style.width = '100%';
            window.location.href = '/admin/audios';
        } else {
            uploadModal.classList.add('hidden');
            uploadModal.classList.remove('flex');
            submitBtn.disabled = false;

            const jsErrorAlert = document.getElementById('jsErrorAlert');
            const jsErrorMessage = document.getElementById('jsErrorMessage');
            jsErrorAlert.classList.remove('hidden');
            
            try {
                const res = JSON.parse(xhr.responseText);
                jsErrorMessage.innerText = res.message || 'Update failed. Please check file sizes and try again.';
            } catch(e) {
                jsErrorMessage.innerText = 'Update failed with status code ' + xhr.status + '. Please check server upload limits.';
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    };

    xhr.onerror = function() {
        uploadModal.classList.add('hidden');
        uploadModal.classList.remove('flex');
        submitBtn.disabled = false;
        alert('Network connection error occurred during upload. Please try again.');
    };

    xhr.send(formData);
});
</script>

@endsection
