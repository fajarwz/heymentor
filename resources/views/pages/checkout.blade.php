@extends('layouts.main')

@section('content')
<section class=" max-w-6xl mx-auto py-10 flex flex-col gap-y-10">
    <div>
        <ul class="flex flex-row gap-x-3">
            <li><a href="{{ route('home') }}" class=" px-8 py-4 text-base font-semibold">
                    Home /
                </a></li>
            <li><a href="{{ route('profile', $mentor->user->username) }}" class=" px-8 py-4 text-base font-semibold">
                    Profile /
                </a></li>
            <li><a href="{{ route('checkout', $mentor->user->username) }}" class=" px-8 py-4 text-base font-semibold">
                    Checkout
                </a></li>
        </ul>
    </div>
    <div class="p-8 border items-center flex flex-row gap-x-4">
        <a href="{{ route('profile', $mentor->user->username) }}">
            <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="" class="object-cover w-[100px] h-[100px] bg-red-100 rounded-full">
        </a>
        <div class="flex flex-col gap-y-2 items-left">
            <a href="{{ route('profile', $mentor->user->username) }}">
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
    <ul class="flex flex-col gap-y-4">
        <li><a href="#">
                total hours: <strong>189 hours</strong>
            </a></li>
        <li><a href="#">
                date and time: <strong>22 jan 2024 at 03.00 am</strong>
            </a></li>
        <li><a href="#">
                price: <strong>$388,309</strong>
            </a></li>
        <li><a href="#">
                tax 25%: <strong>$995,389</strong>
            </a></li>
        <li><a href="#">
                career insurance: <strong>$18,380</strong>
            </a></li>
        <li><a href="#">
                add on tools: <strong>$518,380</strong>
            </a></li>
        <li><a href="#">
                grand total: <strong>$47,518,380</strong>
            </a></li>
    </ul>
    <div>
        <a href="{{ route('checkout.success') }}" class="py-3 px-5 bg-slate-900 text-white font-bold">
            Pay with Midtrans
        </a>
    </div>
</section>
@endsection