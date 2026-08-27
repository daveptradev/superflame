@extends('layouts.app')

@section('title', 'Sessions - Superflame')

@section('content')

<div class="px-8 py-16 text-white text-center">

  <h1 class="text-4xl font-bold mb-10">LIVE SESSIONS</h1>

  <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-10 md:gap-8">

   @foreach($sessions as $s)
<a href="{{ $s->youtube_url }}" target="_blank" class="group block">

  <div class="overflow-hidden rounded-xl">
    <img src="{{ asset('storage/' . $s->image) }}"
class="w-full h-full aspect-video object-cover transition duration-500 group-hover:scale-105">
  </div>

  <div class="mt-3 text-center">
    <h2 class="text-lg font-semibold group-hover:text-red-500 transition">
      {{ $s->title }}
    </h2>
    <p class="text-xs text-gray-400">{{ $s->dj }}</p>
  </div>

</a>
@endforeach
  </div>

</div>

<!-- PLAYER -->
<div id="playerBar"
  class="fixed bottom-0 left-0 w-full bg-black border-t border-gray-800 p-4 hidden">

  <div class="flex items-center justify-between max-w-6xl mx-auto">

    <div>
      <p id="playerTitle" class="font-semibold"></p>
      <p id="playerDJ" class="text-sm text-gray-400"></p>
    </div>

    <audio id="audioPlayer" controls class="w-1/2"></audio>

  </div>

</div>

<script>
function playSet(audio, title, dj){

  const player = document.getElementById('audioPlayer');
  const bar = document.getElementById('playerBar');

  document.getElementById('playerTitle').innerText = title;
  document.getElementById('playerDJ').innerText = dj;

  player.src = audio;
  player.play();

  bar.classList.remove('hidden');
}
</script>

@endsection