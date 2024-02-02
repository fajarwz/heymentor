@extends('layouts.main')

@section('content')
<section class=" max-w-6xl mx-auto py-10 flex flex-col gap-y-10">
    <div>
        <ul class="flex flex-row gap-x-3">
            <li><a href="#" class="bg-slate-800 text-white px-8 py-4 text-base font-semibold">
                    All Roles
                </a></li>
            <li><a href="#" class="bg-slate-100 px-8 py-4 text-base font-semibold">
                    Designer
                </a></li>
            <li><a href="#" class="bg-slate-100 px-8 py-4 text-base font-semibold">
                    Programmer
                </a></li>
            <li><a href="#" class="bg-slate-100 px-8 py-4 text-base font-semibold">
                    Copywriter
                </a></li>
            <li><a href="#" class="bg-slate-100 px-8 py-4 text-base font-semibold">
                    Digital Marketing
                </a></li>
        </ul>
    </div>
    <div class="grid grid-cols-4  gap-x-8 gap-y-8">
        <div class="item-mentor p-8 border items-center flex flex-col gap-y-4">
            <a href="{{ route('profile') }}">
                <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="object-cover w-[60px] h-[60px] bg-red-100 rounded-full">
            </a>
            <div class="flex flex-col gap-y-2 items-center">
                <a href="{{ route('profile') }}">
                    <h3 class="text-xl text-indigo-950 font-bold">
                        Ivanna Link
                    </h3>
                </a>
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
        <div class="item-mentor p-8 border items-center flex flex-col gap-y-4">
            <a href="#">
                <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="object-cover w-[60px] h-[60px] bg-red-100 rounded-full">
            </a>
            <div class="flex flex-col gap-y-2 items-center">
                <a href="#">
                    <h3 class="text-xl text-indigo-950 font-bold">
                        Ivanna Link
                    </h3>
                </a>
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
        <div class="item-mentor p-8 border items-center flex flex-col gap-y-4">
            <a href="#">
                <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="object-cover w-[60px] h-[60px] bg-red-100 rounded-full">
            </a>
            <div class="flex flex-col gap-y-2 items-center">
                <a href="#">
                    <h3 class="text-xl text-indigo-950 font-bold">
                        Ivanna Link
                    </h3>
                </a>
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
        <div class="item-mentor p-8 border items-center flex flex-col gap-y-4">
            <a href="#">
                <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="object-cover w-[60px] h-[60px] bg-red-100 rounded-full">
            </a>
            <div class="flex flex-col gap-y-2 items-center">
                <a href="#">
                    <h3 class="text-xl text-indigo-950 font-bold">
                        Ivanna Link
                    </h3>
                </a>
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
        <div class="item-mentor p-8 border items-center flex flex-col gap-y-4">
            <a href="#">
                <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="object-cover w-[60px] h-[60px] bg-red-100 rounded-full">
            </a>
            <div class="flex flex-col gap-y-2 items-center">
                <a href="#">
                    <h3 class="text-xl text-indigo-950 font-bold">
                        Ivanna Link
                    </h3>
                </a>
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
        <div class="item-mentor p-8 border items-center flex flex-col gap-y-4">
            <a href="#">
                <img src="https://images.unsplash.com/photo-1548142813-c348350df52b?q=80&w=2592&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="object-cover w-[60px] h-[60px] bg-red-100 rounded-full">
            </a>
            <div class="flex flex-col gap-y-2 items-center">
                <a href="#">
                    <h3 class="text-xl text-indigo-950 font-bold">
                        Ivanna Link
                    </h3>
                </a>
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
        <ul class="flex flex-row gap-x-3">
            <li><a href="#" class="bg-slate-800 text-white px-8 py-4 text-base font-semibold">
                    1
                </a></li>
            <li><a href="#" class="bg-slate-100 px-8 py-4 text-base font-semibold">
                    2
                </a></li>
            <li><a href="#" class="bg-slate-100 px-8 py-4 text-base font-semibold">
                    3
                </a></li>
            <li><a href="#" class="bg-slate-100 px-8 py-4 text-base font-semibold">
                    4
                </a></li>
            <li><a href="#" class="bg-slate-100 px-8 py-4 text-base font-semibold">
                    5
                </a></li>
        </ul>
    </div>
</section>
@endsection