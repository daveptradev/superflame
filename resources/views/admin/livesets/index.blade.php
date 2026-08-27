@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>

        <h2 class="text-3xl font-bold">
            Livesets
        </h2>

        <p class="text-gray-500 mt-1">
            Manage DJ sessions & livestreams
        </p>

    </div>

    <button
        onclick="window.location.href='/admin/livesets/create'"
        class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl font-semibold transition">

        + Add Liveset

    </button>

</div>

<div class="grid grid-cols-3 gap-6">

    @foreach($livesets as $liveset)

    <div class="bg-[#111] border border-white/5 rounded-3xl overflow-hidden group">

        <!-- IMAGE -->
        <div class="h-52 bg-[#1a1a1a] relative overflow-hidden">

        <img src="{{ asset('storage/' . $liveset->image) }}"
                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">

            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>

            <div class="absolute bottom-4 left-4">

                <p class="text-xs text-red-500 uppercase tracking-widest">
                    {{ $liveset->genre}}
                </p>

                <h3 class="text-lg font-bold mt-1">
                    {{ $liveset->title }}
                </h3>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-5">

            <div class="flex items-center justify-between">

                <div>

                    <p class="font-semibold mt-1">
                        {{ $liveset->dj }}
                    </p>

                    <p class="text-gray-400 text-sm">
                        {{ $liveset->event }}
                    </p>

                </div>

                <div class="flex gap-2">

                    <button
                        onclick="window.location.href='/admin/livesets/{{ $liveset->id }}/edit'"
                        class="bg-white/5 hover:bg-white/10 px-4 py-2 rounded-xl text-sm transition">
                        Edit
                    </button>

                    <form action="/admin/livesets/{{ $liveset->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this liveset?');">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="bg-red-500/10 hover:bg-red-500/20 text-red-400 px-4 py-2 rounded-xl text-sm transition">
                            Delete
                        </button>
                    </form>
                    

                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>

@endsection