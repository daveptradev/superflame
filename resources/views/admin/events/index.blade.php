@extends('layouts.admin')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>

        <h2 class="text-3xl font-bold">
            Events
        </h2>

        <p class="text-gray-500 mt-1">
            Manage upcoming & past events
        </p>

    </div>

    <button
        onclick="window.location.href='/admin/events/create'"
        class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl font-semibold transition">

        + Add Event

    </button>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

    @forelse($events as $event)

    <div class="bg-[#111] border border-white/5 rounded-3xl overflow-hidden">

        <!-- IMAGE -->
        <div class="h-56 relative overflow-hidden">

            <img src="{{ asset('storage/' . $event->image) }}"
                class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>

            <div class="absolute bottom-4 left-4">

                <span class="bg-red-500/20 text-red-400 text-[10px]
                    px-3 py-1 rounded-full uppercase tracking-widest">

                    {{ $event->status }}

                </span>

                <h3 class="text-2xl font-bold mt-3">
                    {{ $event->title }}
                </h3>

            </div>

        </div>

        <!-- BODY -->
        <div class="p-5">

            <div class="flex items-center justify-between text-sm text-gray-400 mb-5">

                <span>
                    {{ $event->location }}
                </span>

                <span>
                    {{ $event->date }}
                </span>

            </div>

            <div class="flex gap-3">

                <a href="/admin/events/{{ $event->id }}/edit"
                    class="flex-1 text-center bg-white/5 hover:bg-white/10
                    py-3 rounded-2xl transition">

                    Edit

                </a>

                <form action="/admin/events/{{ $event->id }}"
                    method="POST"
                    class="flex-1">

                    @csrf
                    @method('DELETE')

                    <button
                        onclick="return confirm('Delete this event?')"
                        class="w-full bg-red-500/10 hover:bg-red-500/20
                        text-red-400 py-3 rounded-2xl transition">

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

    @empty

    <div class="col-span-3 bg-[#111] border border-white/5 rounded-3xl p-16 text-center">

        <p class="text-gray-500 mb-6">
            No events yet
        </p>

        <button
            onclick="window.location.href='/admin/events/create'"
            class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-2xl font-semibold">

            Create First Event

        </button>

    </div>

    @endforelse

</div>

@endsection