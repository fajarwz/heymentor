@extends('layouts.main')

@section('content')
<section class=" max-w-2xl mx-auto py-10 flex flex-col gap-y-10">
    <div class="p-8 border flex flex-col gap-y-4">
        <h3 class="text-xl text-indigo-950 font-bold">
            Sign In
        </h3>
        <p class="text-sm text-indigo-950">
            Get the best insights from mentor
        </p>
        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-y-5">
            @csrf
            <div class="mb-4">
                <p class="text-sm text-indigo-950">
                    Email Address
                </p>
                <input type="text" name="email" id="email" value="{{ old('email') }}" autofocus class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mb-4">
                <p class="text-sm text-indigo-950">
                    Password
                </p>
                <input type="password" name="password" id="password"
                    class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <a href="#" class="text-blue-400">Forgot Password</a>
            </div>
            <button type="submit" class="w-full bg-slate-950 text-white px-8 py-4 text-base font-semibold">
                Sign In
            </button>
            <a href="{{ route('sign-up') }}" class="w-full text-center bg-slate-300 px-8 py-4 text-base font-semibold">
                Create new account
            </a>
        </form>
    </div>
</section>
@endsection