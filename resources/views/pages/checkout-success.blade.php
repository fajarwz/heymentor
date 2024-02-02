@extends('layouts.main')

@section('content')
<section class=" max-w-6xl mx-auto py-10 flex flex-col gap-y-10">
    <div class="p-8 border items-center flex flex-row gap-x-4">
        <a href="{{ route('profile') }}">
            <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="" class="object-cover w-[100px] h-[100px] bg-red-100 rounded-full">
        </a>
        <div class="flex flex-col gap-y-2 items-left">
            <a href="{{ route('profile') }}">
                <h3 class="text-xl text-indigo-950 font-bold">
                    Ivanna Link
                </h3>
            </a>
            <div class="flex flex-row gap-x-4">
                <p class="text-sm text-indigo-950">
                    UX Designer
                </p>
                <p class="text-sm text-indigo-950">
                    8+ experiences
                </p>
                <p class="text-sm text-indigo-950">
                    193 sessions
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