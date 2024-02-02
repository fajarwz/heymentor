@extends('layouts.main')

@section('content')
<section class=" max-w-6xl mx-auto py-10 flex flex-col gap-y-10">
    <div>
        <ul class="flex flex-row gap-x-3">
            <li><a href="{{ route('home') }}" class=" px-8 py-4 text-base font-semibold">
                    Home /
                </a></li>
            <li><a href="{{ route('profile') }}" class=" px-8 py-4 text-base font-semibold">
                    Mentor Profile
                </a></li>
        </ul>
    </div>
    <div class="p-8 border items-center flex flex-row gap-x-4">
        <a href="{{ route('profile') }}">
            <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="object-cover w-[100px] h-[100px] bg-red-100 rounded-full">
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
    <div class="grid grid-cols-3 gap-x-5">
        <div class="col-span-2 flex flex-col gap-y-10">
            <div class="flex flex-col gap-y-3">
                <h3 class="text-lg font-bold text-indigo-950">
                    About
                </h3>
                <p class="text-base tight-loose">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore laudantium veniam corrupti
                    voluptatibus placeat cumque quidem, modi ducimus quas corporis! Voluptatem, porro atque ullam
                    iusto
                    hic doloremque tenetur numquam amet!
                </p>
                <div class="flex flex-col gap-y-4 mt-5">
                    <p class="text-base text-indigo-950">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                    <p class="text-base text-indigo-950">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                    <p class="text-base text-indigo-950">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
            </div>
            <div class="flex flex-col gap-y-3">
                <h3 class="text-lg font-bold text-indigo-950">
                    Portfolio
                </h3>
                <p class="text-base tight-loose">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                </p>
                <div class="grid grid-cols-2 gap-x-5 gap-y-5">
                    <div class="col-span-1">
                        <img src="https://cdn.dribbble.com/userupload/10670066/file/original-d352b1cd5d172f399da589d5885d34c8.png?resize=1504x1128" alt="" class="object-cover w-full h-[200px]">
                    </div>
                    <div class="col-span-1">
                        <img src="https://cdn.dribbble.com/userupload/10670066/file/original-d352b1cd5d172f399da589d5885d34c8.png?resize=1504x1128" alt="" class="object-cover w-full h-[200px]">
                    </div>
                    <div class="col-span-1">
                        <img src="https://cdn.dribbble.com/userupload/10670066/file/original-d352b1cd5d172f399da589d5885d34c8.png?resize=1504x1128" alt="" class="object-cover w-full h-[200px]">
                    </div>
                    <div class="col-span-1">
                        <img src="https://cdn.dribbble.com/userupload/10670066/file/original-d352b1cd5d172f399da589d5885d34c8.png?resize=1504x1128" alt="" class="object-cover w-full h-[200px]">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="booking-section p-8 border flex flex-col gap-y-4">
                <h3 class="text-xl text-indigo-950 font-bold">
                    Booking Mentor
                </h3>
                <p class="text-sm text-indigo-950">
                    $28,309/hour
                </p>
                <form action="{{ route('checkout') }}">
                    <div class="mb-4">
                        <p class="text-sm text-indigo-950">
                            how many hour?
                        </p>
                        <input type="number" name="" id="" class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-indigo-950">
                            choose date
                        </p>
                        <input type="date" name="" id="" class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-indigo-950">
                            choose time
                        </p>
                        <select name="" id="" class="w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base">
                            <option value="9">09.00 AM</option>
                            <option value="13">01.00 PM</option>
                            <option value="22">10.00 PM</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-slate-300 px-8 py-4 text-base font-semibold">
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection