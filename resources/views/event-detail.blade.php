@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="relative h-[85vh] overflow-hidden">

    <!-- IMAGE -->
    <img
        src="{{ asset('storage/events/plumahead1.png') }}"
        class="absolute inset-0 w-full h-full object-cover">

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/70"></div>

    <!-- CONTENT -->
    <div class="relative z-10 h-full flex items-end">

        <div class="px-6 md:px-14 pb-16 md:pb-24 max-w-5xl">

            <!-- STATUS -->
            <div class="mb-5">

                <span class="
                    px-5 py-2 rounded-full text-xs font-bold uppercase tracking-[2px]

                    {{ $event->status == 'upcoming'
                        ? 'bg-red-600 text-white'
                        : 'bg-gray-700 text-white'
                    }}
                ">

                    {{ $event->status }}

                </span>

            </div>

            <!-- TITLE -->
            <h1 class="text-5xl md:text-8xl font-extrabold text-white leading-none mb-8">
                {{ $event->title }}
            </h1>
            
            <!-- HEADLINER -->
            @if($event->headliner)
            
            <div class="mb-7">
            
                <p class="text-xs tracking-[4px] uppercase text-gray-400 mb-3">
                    Headliner
                </p>
            
                <h2 class="text-3xl md:text-5xl font-extrabold text-white uppercase leading-none">
                    {{ $event->headliner }}
                </h2>
            
            </div>
            
            @endif
            
            <!-- LINEUP -->
            @if($event->lineup)
            
            <div class="mb-10">
            
                <p class="text-xs tracking-[4px] uppercase text-gray-400 mb-3">
                    Lineup
                </p>
            
                <p class="text-lg md:text-2xl text-white/80 uppercase leading-relaxed">
                    {{ $event->lineup }}
                </p>
            
            </div>
            
            @endif
            

            <!-- META -->
            <div class="flex flex-wrap items-center gap-6 text-sm md:text-base text-gray-300 mb-10">

                <div class="flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-red-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                    </svg>

                    {{ $event->date }}

                </div>

                <div class="flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-red-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0L6.343 16.657a8 8 0 1111.314 0z"/>

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>

                    {{ $event->location }}

                </div>

            </div>

            <!-- CTA -->
            <div class="flex flex-wrap gap-4">

               <a href="https://wa.me/6287711225757?text=Halo%20saya%20ingin%20RSVP%20event%20{{ urlencode($event->title) }}"
              target="_blank"
              class="px-8 py-4 rounded-full
              bg-red-600 hover:bg-red-700
              text-white font-bold transition">

    BUY TICKETS / RSVP

</a>

                <a href="/events"
                    class="px-8 py-4 rounded-full
                    border border-white/20
                    text-white hover:border-red-500 transition">

                    BACK TO EVENTS

                </a>

            </div>

        </div>

    </div>

</section>

<!-- EVENT INFO -->
<section class="bg-black border-t border-white/5">

    <div class="px-6 md:px-14 py-10">

        <div class="grid md:grid-cols-3 gap-6">

            <!-- DATE -->
            <div class="bg-[#111] border border-white/5 rounded-3xl p-7">

                <p class="text-xs tracking-[3px] uppercase text-gray-500 mb-3">
                    Event Date
                </p>

                <h3 class="text-white text-xl font-bold">
                    {{ $event->date }}
                </h3>

            </div>

            <!-- LOCATION -->
            <div class="bg-[#111] border border-white/5 rounded-3xl p-7">

                <p class="text-xs tracking-[3px] uppercase text-gray-500 mb-3">
                    Location
                </p>

                <h3 class="text-white text-xl font-bold">
                    {{ $event->location }}
                </h3>

            </div>

            <!-- STATUS -->
            <div class="bg-[#111] border border-white/5 rounded-3xl p-7">

                <p class="text-xs tracking-[3px] uppercase text-gray-500 mb-3">
                    Status
                </p>

                <h3 class="text-white text-xl font-bold uppercase">
                    {{ $event->status }}
                </h3>

            </div>

        </div>

    </div>

</section>

<!-- ABOUT -->
<section class="px-6 md:px-14 py-20 bg-[#0a0a0a]">

    <div class="max-w-4xl">

        <p class="text-xs tracking-[4px] uppercase text-red-500 mb-5">
            About Event
        </p>

        <h2 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-10">
            EXPERIENCE THE NEXT CHAPTER OF SUPERFLAME
        </h2>

        <div class="text-gray-400 text-lg leading-[2.1] whitespace-pre-line">
            {{ $event->description }}
        </div>

    </div>

</section>

@endsection