@extends('layouts.admin')

@section('content')

<div class="max-w-4xl">

    <h1 class="text-3xl font-bold mb-8">
        Edit Event
    </h1>

    <form action="/admin/events/{{ $event->id }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf
        @method('PUT')

        <!-- TITLE -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Event Title
            </label>

            <input type="text"
                name="title"
                value="{{ $event->title }}"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        </div>

        <!-- LOCATION -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Location
            </label>

            <input type="text"
                name="location"
                value="{{ $event->location }}"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        </div>

        <!-- DATE -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Event Date
            </label>

            <input type="date"
                name="date"
                value="{{ $event->date }}"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        </div>

        <!-- STATUS -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Status
            </label>

            <select
                name="status"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

                <option value="upcoming"
                    {{ $event->status == 'upcoming' ? 'selected' : '' }}>

                    Upcoming

                </option>

                <option value="completed"
                    {{ $event->status == 'completed' ? 'selected' : '' }}>

                    Completed

                </option>

            </select>

        </div>
        
        <!-- HEADLINER -->
        <div>
        
            <label class="block mb-2 text-sm text-gray-400">
                Headliner DJ
            </label>
        
            <input type="text"
                name="headliner"
                value="{{ $event->headliner }}"
                placeholder="BABY J"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">
        
        </div>


        <!-- LINEUP -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Lineup
            </label>

            <textarea
                name="lineup"
                rows="4"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">{{ $event->lineup }}</textarea>

        </div>

        <!-- DESCRIPTION -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Description
            </label>

            <textarea
                name="description"
                rows="6"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">{{ $event->description }}</textarea>

        </div>

        <!-- CURRENT IMAGE -->
        <div>

            <label class="block mb-3 text-sm text-gray-400">
                Current Poster
            </label>

            <img src="{{ asset('storage/' . $event->image) }}"
                class="w-64 rounded-2xl border border-white/10">

        </div>

        <!-- NEW IMAGE -->
        <div>

            <label class="block mb-2 text-sm text-gray-400">
                Replace Poster
            </label>

            <input type="file"
                name="image"
                class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        </div>

        <!-- BUTTON -->
        <button
            class="bg-red-600 hover:bg-red-700 px-8 py-4 rounded-2xl font-semibold transition">

            Update Event

        </button>

    </form>

</div>

@endsection