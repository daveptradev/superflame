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
      Welcome Back
    </h2>
    <p class="text-gray-400 text-sm text-center mb-6">
      Enter the flame again 🔥
    </p>

    <!-- FORM -->
    <form action="/login" method="POST" class="space-y-4">
  @csrf

  <!-- EMAIL -->
  <div>
    <label class="text-sm text-gray-400">Email</label>
    <input 
      type="email" 
      name="email"
      placeholder="you@email.com"
      class="w-full mt-1 px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"
    >
  </div>

  <!-- PASSWORD -->
  <div>
    <label class="text-sm text-gray-400">Password</label>
    <input 
      type="password" 
      name="password"
      placeholder="••••••••"
      class="w-full mt-1 px-4 py-2 bg-gray-900 border border-gray-700 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500"
    >
  </div>

  <!-- OPTIONS -->
  <div class="flex justify-between items-center text-sm text-gray-400">
    <label class="flex items-center space-x-2">
      <input type="checkbox" name="remember" class="accent-red-600">
      <span>Remember me</span>
    </label>

    <a href="#" class="hover:text-red-500">
      Forgot Password?
    </a>
  </div>

  <!-- BUTTON -->
  <button 
    type="submit"
    class="w-full bg-red-600 py-2 rounded-lg font-semibold hover:bg-red-700 transition"
  >
    Sign In
  </button>

</form>

    <!-- SIGN UP LINK -->
    <p class="text-center text-sm text-gray-400 mt-6">
      Don't have an account?
      <a href="/signup" class="text-red-500 hover:underline">Sign Up</a>
    </p>

  </div>

</body>
@endsection