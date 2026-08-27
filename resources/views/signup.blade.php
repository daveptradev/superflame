@extends('layouts.app')

@section('content')

<body class="text-white font-sans flex items-center justify-center min-h-screen">

  <!-- CONTAINER -->
  <div class="w-full max-w-md bg-black border border-gray-800 p-8 rounded-xl shadow-lg ms-auto me-auto mt-16 mb-16">

    <!-- LOGO -->
    <h1 class="text-3xl font-bold text-red-600 text-center mb-6">
      SUPERFLAME
    </h1>

    <!-- TITLE -->
    <h2 class="text-xl font-semibold text-center mb-2">
      Create Account
    </h2>
    <p class="text-gray-400 text-sm text-center mb-6">
      Join the underground movement
    </p>

<form action="/register" method="POST" class="space-y-4">
  @csrf

  <!-- NAME -->
  <div>
    <label class="text-sm text-gray-400">Full Name</label>
    <input 
      type="text" 
      name="name"
      placeholder="Your name"
      class="w-full mt-1 px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg"
    >
  </div>

  <!-- EMAIL -->
  <div>
    <label class="text-sm text-gray-400">Email</label>
    <input 
      type="email" 
      name="email"
      placeholder="you@email.com"
      class="w-full mt-1 px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg"
    >
  </div>

  <!-- PASSWORD -->
  <div>
    <label class="text-sm text-gray-400">Password</label>
    <input 
      type="password" 
      name="password"
      placeholder="••••••••"
      class="w-full mt-1 px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg"
    >
  </div>

  <!-- CONFIRM PASSWORD -->
  <div>
    <label class="text-sm text-gray-400">Confirm Password</label>
    <input 
      type="password" 
      name="password_confirmation"
      placeholder="••••••••"
      class="w-full mt-1 px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg"
    >
  </div>

  <button type="submit"
    class="w-full bg-red-600 py-2 rounded-lg font-semibold hover:bg-red-700">
    Sign Up
  </button>
</form>

    <!-- LOGIN LINK -->
    <p class="text-center text-sm text-gray-400 mt-6">
      Already have an account?
      <a href="#" class="text-red-500 hover:underline">Sign In</a>
    </p>

  </div>

</body>

@endsection

