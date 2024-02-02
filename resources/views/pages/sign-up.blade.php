@extends('layouts.main')

@section('content')
<section class=" max-w-2xl mx-auto py-10 flex flex-col gap-y-10">
    <div class="p-8 border flex flex-col gap-y-4">
        <h3 class="text-xl text-indigo-950 font-bold">
            Sign Up
        </h3>
        <p class="text-sm text-indigo-950">
            Get the best insights from mentor
        </p>
        <form action="" class="flex flex-col gap-y-5">
            <div class="mb-4">
                <p class="text-sm text-indigo-950">
                    complete name
                </p>
                <input type="text" name="" id="" class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
            </div>
            <div class="mb-4">
                <p class="text-sm text-indigo-950">
                    phone number
                </p>
                <input type="text" name="" id="" class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
            </div>
            <div class="mb-4">
                <p class="text-sm text-indigo-950">
                    email address
                </p>
                <input type="text" name="" id="" class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
            </div>
            <div class="mb-4">
                <p class="text-sm text-indigo-950">
                    password
                </p>
                <input type="password" name="" id=""
                    class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
            </div>
            <button type="submit" class="w-full bg-slate-950 text-white px-8 py-4 text-base font-semibold">
                Sign Up
            </button>
            <a href="{{ route('sign-in') }}" class="w-full text-center bg-slate-300 px-8 py-4 text-base font-semibold">
                Sign In to my Account
            </a>
        </form>
    </div>
</section>

@endsection