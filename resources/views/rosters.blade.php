@extends('layouts.app')

@section('title', 'Rosters - Superflame')

@section('content')

<!-- SECTION MANAGEMENT -->
<section class="px-0 md:px-4 py-4 md:py-8">

    <!-- Mobile -->
    <section class="w-full">

    <!-- Mobile -->
    <img
        src="{{ asset('assets/sfhp1.png') }}"
        alt="Roster Mobile"
        class="block md:hidden w-full h-auto">

    <!-- Desktop -->
    <img
        src="{{ asset('assets/sfall1.png') }}"
        alt="Roster Desktop"
        class="hidden md:block w-full h-auto">

</section>
    
  <!-- TITLE -->
  <h2 class="text-4xl md:text-5xl font-bold text-center mb-10 mt-6 md:mt-10">
    SUPERFLAME ROSTERS
  </h2>

  <!-- GRID TALENT -->
  <div class="grid grid-cols-2 md:grid-cols-6 gap-3 md:gap-8 px-3 md:px-0">

<!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
  <img src="assets/absat.png" 
       class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
      </div>

      <a href="https://www.instagram.com/abesatriaa/" target="_blank">
        <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
          ABSAT
        </button>
      </a>
    </div>
    
    <!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
  <img src="assets/david g.png" 
       class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
</div>

      <a href="https://www.instagram.com/davidgeraldy_/" target="_blank">
        <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
          DAVID G
        </button>
      </a>
    </div>

    <!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
  <img src="assets/dhiva1.png" 
       class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
</div>

      <a href="https://www.instagram.com/dhivaa.erik/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        DHIVA
      </button>
      </a>
    </div>

    <!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
  <img src="assets/diego.png" 
       class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
</div>

      <a href="https://www.instagram.com/ghoffarmadani/" target="_blank">
        <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
          DIEGO
        </button>
      </a>
    </div>

    

    <!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
  <img src="assets/dave.png" 
       class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
</div>
    <a href="https://www.instagram.com/daveptraa_/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        DAVE
      </button>
     </a>
    </div>

    <!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
  <img src="assets/aviv.png" 
       class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
</div>
        
        <a href="https://www.instagram.com/instafif/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        AVIV
      </button>
      </a>
    </div>

    <!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
  <img src="assets/roses.png" 
       class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
</div>

    <a href="https://www.instagram.com/rossyfbrthy/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        ROSES
      </button>
    </a>
    </div>

    <!-- TALENT -->
    <div class="text-center group">
     <div class="overflow-hidden aspect-[4/5] bg-black">
        <img src="assets/james.png" 
              class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
      </div>

        <a href="https://www.instagram.com/jamespijar/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        JAMES
      </button>
      </a>
    </div>

    <!-- TALENT -->
    <div class="text-center group">
     <div class="overflow-hidden aspect-[4/5] bg-black">
        <img src="assets/kylie3.png" 
              class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
      </div>

        <a href="https://www.instagram.com/kylie_zra/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        KYLIE
      </button>
      </a>
    </div>

    <!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
        <img src="assets/fachmi2.png" 
             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
      </div>

        <a href="https://www.instagram.com/fachmiabdillahalamudy/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        FACHMI
      </button>
      </a>
    </div>
    
    <!-- TALENT -->
    <div class="text-center group">
       <div class="overflow-hidden aspect-[4/5] bg-black">
        <img src="img/kegoimg.png" 
             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
</div>

        <a href="https://www.instagram.com/kevinn_nugroho/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        KEGO
      </button>
      </a>
    </div>
    
    <!-- TALENT -->
    <div class="text-center group">
      <div class="overflow-hidden aspect-[4/5] bg-black">
        <img src="img/melchiorimg.png" 
             class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition duration-500">
</div>
      
       
        <a href="https://www.instagram.com/melchiorknapp/" target="_blank">
      <button class="mt-4 border border-gray-600 px-4 py-2 text-sm tracking-widest hover:border-red-500 hover:text-red-500 transition">
        KNAPP
      </button>
      </a>
    </div>

  </div>

</section>
@endsection