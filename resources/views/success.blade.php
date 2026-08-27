@extends('layouts.app')

@section('content')

<div class="flex flex-col items-center justify-center h-[70vh] text-white">

  <h1 class="text-4xl font-bold mb-4 text-green-500">
    Payment Success 🎉
  </h1>

  <p class="text-gray-400 mb-6">
    Thank you for your purchase.
  </p>

  <a href="/shop"
    class="bg-red-600 px-6 py-3 rounded-lg hover:bg-red-700">
    Back to Shop
  </a>

</div>

@endsection