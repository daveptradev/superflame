@extends('layouts.admin')

@section('content')

<div class="max-w-4xl">

    <h1 class="text-3xl font-bold mb-8">
        Add Liveset
    </h1>

    <form action="/admin/livesets"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6">

        @csrf

        <!-- TITLE -->
        <input type="text"
            name="title"
            placeholder="Liveset Title"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <!-- DJ -->
        <input type="text"
            name="dj"
            placeholder="DJ Name"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <!-- EVENT -->
        <input type="text"
            name="event"
            placeholder="Event Name"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <!-- GENRE -->
        <input type="text"
            name="genre"
            placeholder="Genre"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <!-- DURATION -->
        <input type="text"
            name="duration"
            placeholder="Duration"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <!-- YOUTUBE -->
        <input type="text"
            name="youtube_url"
            placeholder="YouTube URL"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <!-- AUDIO -->
        <input type="text"
            name="audio_url"
            placeholder="SoundCloud / Audio URL"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <!-- DATE -->
        <input type="date"
            name="release_date"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <!-- DESCRIPTION -->
        <textarea
            name="description"
            rows="5"
            placeholder="Description"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4"></textarea>

        <!-- IMAGE -->
        <input type="file"
            name="image"
            class="w-full bg-[#111] border border-white/10 rounded-2xl px-5 py-4">

        <button
            class="bg-red-600 hover:bg-red-700 px-8 py-4 rounded-2xl font-semibold transition">

            Save Liveset

        </button>

    </form>

</div>

@endsection