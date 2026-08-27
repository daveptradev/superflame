@extends('layouts.admin')

@section('content')

<div class="max-w-4xl">

    <!-- TOP HEADER -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold">
                Edit Audio
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
                    Title <span class="text-red-500">*</span>
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
                    <option value="TRACKS" {{ old('category', $audio->category) == 'TRACKS' ? 'selected' : '' }}>TRACKS</option>
                    <option value="ALBUM" {{ old('category', $audio->category) == 'ALBUM' ? 'selected' : '' }}>ALBUM</option>
                    <option value="EDIT PACK" {{ old('category', $audio->category) == 'EDIT PACK' ? 'selected' : '' }}>EDIT PACK</option>
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
                       placeholder="https://soundcloud.com/..."
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
                      rows="4"
                      placeholder="Brief description about this release..."
                      class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition leading-relaxed">{{ old('description', $audio->description) }}</textarea>
        </div>

        <!-- CURRENT COVER IMAGE & REPLACE -->
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

        <!-- OPTIONAL AUDIO FILE -->
        <div>
            <label class="block text-sm font-semibold text-gray-300 mb-2">
                Audio File (Optional MP3 / WAV)
            </label>

            @if($audio->audio_file)
            <div class="mb-4 flex items-center gap-4 bg-[#161616] p-4 rounded-2xl border border-white/5">
                <div class="w-10 h-10 bg-red-500/20 text-red-400 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-white">Current Audio File Uploaded</p>
                    <p class="text-xs text-gray-500">{{ $audio->audio_file }}</p>
                </div>
            </div>
            @endif

            <input type="file"
                   name="audio_file"
                   accept="audio/*"
                   class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4 text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-white/10 file:text-white hover:file:bg-white/20 transition">
        </div>

        <!-- SUBMIT -->
        <div class="pt-4 flex items-center gap-4">
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 px-8 py-4 rounded-2xl font-semibold transition inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Update Audio
            </button>

            <a href="/admin/audios"
               class="bg-white/5 hover:bg-white/10 px-8 py-4 rounded-2xl font-semibold transition">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection
