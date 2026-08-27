@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center px-6">

    <div class="max-w-md w-full bg-[#111] border border-gray-800 rounded-2xl p-8 text-center">

        <h1 class="text-2xl font-bold text-white mb-4">
            Verify Your Email
        </h1>

        <p class="text-gray-400 mb-6">
            We have sent a verification link to your email.
            Please verify your account before logging in.
        </p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <button
                class="w-full bg-red-600 py-3 rounded-xl hover:bg-red-700 transition">
                Resend Verification Email
            </button>
        </form>

    </div>

</div>

@endsection