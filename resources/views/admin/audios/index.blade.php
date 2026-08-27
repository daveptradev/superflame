@extends('layouts.admin')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h2 class="text-3xl font-bold">
            Audio & Tracks
        </h2>
        <p class="text-gray-500 mt-1">
            Manage audio releases, SoundCloud links, packs & albums
        </p>
    </div>

    <a href="/admin/audios/create"
       class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl font-semibold transition flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add Audio
    </a>
</div>

<!-- SUCCESS ALERT -->
@if(session('success'))
<div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 px-5 py-4 rounded-2xl flex items-center gap-3">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    <span>{{ session('success') }}</span>
</div>
@endif

<!-- AUDIO GRID -->
@if($audios->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($audios as $audio)
    <div class="bg-[#111] border border-white/5 rounded-3xl overflow-hidden group hover:border-red-500/30 transition duration-300 flex flex-col justify-between">

        <div>
            <!-- COVER IMAGE -->
            <div class="h-52 bg-[#1a1a1a] relative overflow-hidden">
                @if($audio->image)
                    <img src="{{ asset('storage/' . $audio->image) }}"
                         alt="{{ $audio->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-600 bg-[#161616]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                        </svg>
                    </div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                <!-- CATEGORY BADGE -->
                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-black/60 backdrop-blur border border-white/10 text-red-500 text-xs font-bold uppercase tracking-wider rounded-full">
                        {{ $audio->category ?: 'TRACKS' }}
                    </span>
                </div>

                <!-- TITLE ON IMAGE -->
                <div class="absolute bottom-4 left-4 right-4">
                    <p class="text-xs text-red-400 uppercase tracking-widest font-semibold">
                        {{ $audio->artist ?: 'SUPERFLAME' }}
                    </p>
                    <h3 class="text-lg font-bold text-white mt-0.5 truncate" title="{{ $audio->title }}">
                        {{ $audio->title }}
                    </h3>
                </div>
            </div>

            <!-- DETAILS -->
            <div class="p-5 space-y-3">
                @if($audio->description)
                <p class="text-gray-400 text-sm line-clamp-2 leading-relaxed">
                    {{ $audio->description }}
                </p>
                @endif

                <div class="text-xs text-gray-500 space-y-1 pt-1">
                    @if($audio->release_date)
                    <div class="flex items-center gap-2">
                        <span class="text-gray-400">Release:</span>
                        <span>{{ \Carbon\Carbon::parse($audio->release_date)->format('d M Y') }}</span>
                    </div>
                    @endif

                    @if($audio->audio_url)
                    <div class="flex items-center gap-2 truncate">
                        <span class="text-gray-400">Stream:</span>
                        <a href="{{ $audio->audio_url }}" target="_blank" class="text-red-400 hover:underline truncate">
                            {{ $audio->audio_url }}
                        </a>
                    </div>
                    @endif

                    @if($audio->buy_url)
                    <div class="flex items-center gap-2 truncate">
                        <span class="text-gray-400">Link:</span>
                        <a href="{{ $audio->buy_url }}" target="_blank" class="text-cyan-400 hover:underline truncate">
                            {{ $audio->buy_url }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ACTIONS -->
        <div class="p-5 pt-0 border-t border-white/5 flex items-center justify-end gap-2 mt-4">
            <a href="/admin/audios/{{ $audio->id }}/edit"
               class="bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl text-sm font-medium transition">
                Edit
            </a>

            <form action="/admin/audios/{{ $audio->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this audio?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-500/10 hover:bg-red-500/20 text-red-400 px-4 py-2 rounded-xl text-sm font-medium transition">
                    Delete
                </button>
            </form>
        </div>

    </div>
    @endforeach

</div>
@else
<!-- EMPTY STATE -->
<div class="bg-[#111] border border-white/5 rounded-3xl p-12 text-center max-w-xl mx-auto my-12">
    <div class="w-16 h-16 mx-auto mb-4 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
        </svg>
    </div>
    <h3 class="text-xl font-bold text-white mb-2">No Audio Found</h3>
    <p class="text-gray-500 text-sm mb-6">You haven't added any tracks or albums yet.</p>
    <a href="/admin/audios/create"
       class="inline-block bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl font-semibold transition">
        + Add First Audio
    </a>
</div>
@endif

@endsection
