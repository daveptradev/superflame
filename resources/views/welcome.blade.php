@extends('layouts.app')

@section('content')
<!-- HERO -->
<section class="relative min-h-[75vh] md:h-screen
bg-cover md:bg-cover
bg-center md:bg-center
bg-no-repeat"
   
   <section class="relative min-h-[75vh] md:h-screen overflow-hidden">

    <!-- DESKTOP BG -->
    <img
        src="{{ asset('assets/sfbg11.png') }}"
        class="hidden md:block absolute inset-0
        w-full h-full object-cover object-center"
    >

    <!-- MOBILE BG -->
    <img
        src="{{ asset('assets/sss1.png') }}"
        class="block md:hidden absolute inset-0
        w-full h-full object-cover object-center"
    >

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/20"></div>

    <!-- CONTENT -->
    <div class="
    absolute inset-0
    flex flex-col
    justify-center
    items-center
    translate-y-12
    md:translate-y-56
    z-10
    ">

        <a href="https://superflame.live/shop"
        target="_blank"
        class="
            inline-block
            border border-red-500
            text-red-500
            px-5 py-4
            text-sm
            tracking-[2px]
            font-semibold
            uppercase
            backdrop-blur-sm
            bg-red-500/10
            hover:bg-red-600
            hover:text-white
            transition
        ">

            SHOP NOW

        </a>

        <p class="
        mt-4
        text-white
        text-sm md:text-base
        font-bold
        tracking-[5px]
        uppercase
        text-center
        leading-relaxed
        ">
            <br>
            
        </p>

    </div>

</section>

</div>

</section>

  <!-- EVENTS -->
  <section class="px-8 py-10 bg-black">

    <h3 class="text-3xl font-bold mb-8">
        UPCOMING EVENTS
    </h3>

    <!-- CENTER -->
   <div class="overflow-x-auto scrollbar-hide">

    <div class="
        flex
        gap-6
        md:grid
        md:justify-center
        md:[grid-template-columns:repeat(auto-fit,minmax(260px,260px))]
        w-max
        md:w-full
        pb-4
    ">
        
        <a href="/events/super-joiway"
   class="
   w-[200px]
   md:w-[260px]
   flex-shrink-0
   bg-transparent
   p-3
   md:p-4
   hover:scale-105
   transition
   block
">

    <div class="mb-4 overflow-hidden aspect-[4/5] rounded-lg">

        <img
            src="/flyer/joiway.jpg"
            class="w-full h-full object-cover"
        />

    </div>

    <h4 class="font-semibold">
        SUPERFLAME x JOIWAY | Ramble Coffee Terban | 20 July 2026
    </h4>

    <p class="text-gray-400 text-sm">
       Event supported by: @joiway_id
    </p>

</a>


<a href="/events/java-trip-2026"
   class="
   w-[200px]
   md:w-[260px]
   flex-shrink-0
   bg-transparent
   p-3
   md:p-4
   hover:scale-105
   transition
   block
">

    <div class="mb-4 overflow-hidden aspect-[4/5] rounded-lg">

        <img
            src="/flyer/JVT.png"
            class="w-full h-full object-cover"
        />

    </div>

    <h4 class="font-semibold">
        JAVA TRIP TOUR | JAVA ISLAND | 14 May - 12 JUNE 2026
    </h4>

    <p class="text-gray-400 text-sm">
        Special JAVA TRIP
    </p>

</a>

            <a href="/events/pon-your-tone-x-superflame"
   class="
   w-[200px]
   md:w-[260px]
   flex-shrink-0
   bg-transparent
   p-3
   md:p-4
   hover:scale-105
   transition
   block
">

    <div class="mb-4 overflow-hidden aspect-[4/5] rounded-lg">

        <img
            src="/flyer/PYT.png"
            class="w-full h-full object-cover"
        />

    </div>

    <h4 class="font-semibold">
        PON YOUR TONE X SUPERFLAME | VAMOS JOGJA | 23 May 2026
    </h4>

    <p class="text-gray-400 text-sm">
        Special 2nd anniversary Vamos
    </p>

</a>

    <a href="/events/substance"
   class="
   w-[200px]
   md:w-[260px]
   flex-shrink-0
   bg-transparent
   p-3
   md:p-4
   hover:scale-105
   transition
   block
">

    <div class="mb-4 overflow-hidden aspect-[4/5] rounded-lg">

        <img
            src="/flyer/pluma.png"
            class="w-full h-full object-cover"
        />

    </div>

    <h4 class="font-semibold">
        SUBSTANCE | VAMOS JOGJA | 22 May 2026
    </h4>

    <p class="text-gray-400 text-sm">
        Special 2nd anniversary Vamos
    </p>

</a>

            <a href="/events/supernrg"
   class="
   w-[200px]
   md:w-[260px]
   flex-shrink-0
   bg-transparent
   p-3
   md:p-4
   hover:scale-105
   transition
   block
">

    <div class="mb-4 overflow-hidden aspect-[4/5] rounded-lg">

        <img
            src="/flyer/nrg.png"
            class="w-full h-full object-cover"
        />

    </div>

    <h4 class="font-semibold">
        SUPER NRG | VAMOS JOGJA | 20 APR 2026
    </h4>

    <p class="text-gray-400 text-sm">
         NRG TOUR 2026
    </p>

</a>

           

        </div>

    </div>

    <div class="flex justify-end mt-8">
        <a href="/events"
           class="bg-black px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition duration-300 flex items-center gap-2">

            MORE <span>&rarr;</span>

        </a>
    </div>

</section>

  <!-- WARDROBE -->
<section class="relative min-h-[75vh] md:h-screen
bg-contain md:bg-cover
bg-top md:bg-center
bg-no-repeat"
style="background-image: url('{{ asset('img/model7.jpg') }}')">

    <!-- CONTENT -->
    <div class="absolute inset-0 flex
justify-center md:justify-end
items-end
px-6 md:px-16
pb-10 md:pb-16">

        <div class="text-right max-w-md">

            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 tracking-wide">
                SUPERFLAME: <span class="text-red-500">WARDROBE</span>
            </h1>

            <p class="text-gray-300 mb-6 leading-relaxed">
                Limited drops inspired by nightlife energy. Built for movement, identity, and presence.
            </p>

            <a href="/shop"
               class="inline-block px-6 py-3 border border-white/30 text-white text-sm tracking-widest
               hover:bg-red-600 hover:border-red-600 transition duration-300">
               SHOP NOW
            </a>

        </div>

    </div>

</section>

  

  <!-- SESSIONS -->
<section class="px-8 py-16">
  <h3 class="text-3xl font-bold mb-8">SUPERFLAME SELECT</h3>

  <div class="grid md:grid-cols-5 gap-6">

    <!-- ITEM 1 -->
    <a href="https://www.youtube.com/watch?v=_Eg2-yZNc8w" class="bg-transparent p-4 hover:scale-105 transition block">
      <div class="h-48 mb-4 overflow-hidden">
        <img 
          src="/img/dhivatmb.png" 
          alt="DJ SET 1"
          class="w-full h-full object-cover"
        />
      </div>
      <h4 class="font-semibold">DHIVA DJ SET | VAMOS JOGJA</h4>
      <p class="text-gray-400 text-sm">Tech House / Live Mix</p>
    </a>

    <!-- ITEM 2 -->
    <a href="https://www.youtube.com/watch?v=oxsM19jV078&t=11s" target="_blank" class="bg-transparent p-4 hover:scale-105 transition block">
      <div class="h-48 mb-4 overflow-hidden">
        <img 
          src="/img/davidgtmb.png" 
          alt="DJ SET 2"
          class="w-full h-full object-cover"
        />
      </div>
      <h4 class="font-semibold">DAVID G LIVE SET SUPERFLAME | VAMOS JOGJA</h4>
      <p class="text-gray-400 text-sm">Afro / Groove Session</p>
    </a>

    <!-- ITEM 3 -->
    <a href="https://www.youtube.com/watch?v=4iaflwBTZAw" target="_blank" class="bg-transparent p-4 hover:scale-105 transition block">
      <div class="h-48 mb-4 overflow-hidden">
        <img 
          src="/img/davetmb.jpg" 
          alt="DJ SET 3"
          class="w-full h-full object-cover"
        />
      </div>
      <h4 class="font-semibold">DAVE DJ SET | VAMOS JOGJA</h4>
      <p class="text-gray-400 text-sm">House / Night Vibes</p>
    </a>

        <!-- ITEM 3 -->
    <a href="https://www.youtube.com/watch?v=u2QoVFXZYJA&t=436s" target="_blank" class="bg-transparent p-4 hover:scale-105 transition block">
      <div class="h-48 mb-4 overflow-hidden">
        <img 
          src="/img/rosterstmb.jpg" 
          alt="DJ SET 3"
          class="w-full h-full object-cover"
        />
      </div>
      <h4 class="font-semibold">SUPERFLAME ROSTERS DJ SET | VAMOS JOGJA</h4>
      <p class="text-gray-400 text-sm">House / Night Vibes</p>
    </a>

            <!-- ITEM 3 -->
    <a href="https://www.youtube.com/watch?v=vGYUozYrTAU" target="_blank" class="bg-transparent p-4 hover:scale-105 transition block">
      <div class="h-48 mb-4 overflow-hidden">
        <img 
          src="/img/davidxdavetmb.jpg" 
          alt="DJ SET 3"
          class="w-full h-full object-cover"
        />
      </div>
      <h4 class="font-semibold">DAVID G X DAVE DJ SET | VAMOS JOGJA</h4>
      <p class="text-gray-400 text-sm">House / Night Vibes</p>
    </a>

  </div>

  <!-- MORE BUTTON (Right aligned) -->
  <div class="flex justify-end mt-8">
    <a href="/sessions" class="bg-transparent px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition duration-300 flex items-center gap-2">
      MORE <span>&rarr;</span>
    </a>
  </div>
</section>


@endsection