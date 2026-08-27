@extends('layouts.app')

@section('title', 'Events - Superflame')

@section('content')

<section class="px-8 py-16 bg-[#0f0f10] min-h-screen text-white">

  <!-- TITLE -->
  <div class="mb-12 text-center">
    <h1 class="text-4xl font-extrabold tracking-widest">
      EVENTS
    </h1>
    <p class="text-gray-400 text-sm mt-2">
      Superflame live experiences & upcoming drops
    </p>
  </div>

  <!-- GRID -->
  <div class="grid md:grid-cols-3 gap-8">

    @foreach($events as $event)
    <div class="group relative overflow-hidden rounded-xl border border-gray-800 
      bg-[#151517] hover:border-red-500 transition duration-300">

      <!-- IMAGE -->
      <div class="relative overflow-hidden">
        <img src="{{ asset('storage/' . $event->image) }}"
          class="w-full aspect-[4/5] object-cover rounded-xl">

        <!-- OVERLAY -->
        <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition"></div>

        <!-- DATE -->
        <div class="absolute top-4 left-4 bg-black/70 backdrop-blur px-3 py-1 text-xs tracking-widest">
          {{ $event->date }}
        </div>

      </div>

      <!-- CONTENT -->
      <div class="p-5">

        <h2 class="text-xl font-bold mb-1 group-hover:text-red-500 transition">
          {{ $event->title }}
        </h2>

        <p class="text-gray-400 text-sm mb-3">
          {{ $event->location }}
        </p>
        
        <!-- LINEUP -->
        <p class="text-xs text-white mb-3">
          {{ $event->headliner }}
        </p>

        <!-- LINEUP -->
        <p class="text-xs text-white mb-4">
          {{ $event->lineup }}
        </p>

        <!-- BUTTON -->
        <a href="/events/{{ $event->slug }}"
          class="inline-block text-xs border border-gray-700 px-4 py-2 rounded-full 
          hover:border-red-500 hover:text-red-500 transition">
          View Details
        </a>

      </div>

    </div>
    @endforeach

  </div>

</section>

@endsection