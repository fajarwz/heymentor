@extends('layouts.main')

@section('content')
<section class=" max-w-6xl mx-auto py-10 flex flex-col gap-y-10">
    <div>
        <ul class="flex flex-row gap-x-3">
            @foreach ($titles as $title)
            <li>
                <a href="{{ route('home', ['title' => $title['slug']]) }}" class="{{ $currentTitle === $title['slug'] ? 'bg-slate-800 text-white' : 'bg-slate-100' }} px-8 py-4 text-base font-semibold">
                    {{ $title['name'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="grid grid-cols-4 gap-x-8 gap-y-8">
        @forelse ($mentors as $mentor)
        <div class="item-mentor p-8 border items-center flex flex-col gap-y-4">
            <a href="{{ route('profile', $mentor->user->username) }}">
                <img src="{{ $mentor->user->image }}" alt="" class="object-cover w-[60px] h-[60px] bg-red-100 rounded-full">
            </a>
            <div class="flex flex-col gap-y-2 items-center">
                <a href="{{ route('profile', $mentor->user->username) }}">
                    <h3 class="text-xl text-indigo-950 font-bold">
                        {{ $mentor->user->name }}
                    </h3>
                </a>
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
        @empty
        <div>No mentors can be shown.</div>
        @endforelse
    </div>
    <div>
        {{ $mentors->links() }}
    </div>
</section>
@endsection