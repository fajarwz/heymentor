@extends('layouts.main')

@section('content')
<section class=" max-w-6xl mx-auto py-10 flex flex-col gap-y-10">
    <div class="p-8 border items-center flex flex-row gap-x-4">
        <a href="{{ route('profile', $mentor->user->username) }}">
            <img src="{{ $mentor->user->image }}"
                alt="" class="object-cover w-[100px] h-[100px] bg-red-100 rounded-full">
        </a>
        <div class="flex flex-col gap-y-2 items-left">
            <a href="{{ route('profile', $mentor->user->username) }}">
                <h3 class="text-xl text-indigo-950 font-bold">
                    {{ $mentor->user->name }}
                </h3>
            </a>
            <div class="flex flex-row gap-x-4">
                <p class="text-sm text-indigo-950">
                    {{ $mentor->title->name }}
                </p>
                <p class="text-sm text-indigo-950">
                    {{ (now()->year - $mentor->start_date_experience->year) . '+ years experience' }}
                </p>
                <p class="text-sm text-indigo-950">
                    {{ $mentor->total_sessions . ' sessions' }}
                </p>
            </div>
        </div>
    </div>
    <div>
        <h1 class="font-bold text-3xl mb-2">
            Success Booking
        </h1>
        <p>
            We will inform you next instruction of connect with the mentor through your email.
        </p>
    </div>
    <div>
        <a href="{{ route('home') }}" class="py-3 px-5 bg-slate-900 text-white font-bold">
            Explore Other Mentors
        </a>
    </div>
</section>
@endsection