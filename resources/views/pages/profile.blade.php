@extends('layouts.main')

@section('content')
<section class=" max-w-6xl mx-auto py-10 flex flex-col gap-y-10">
    <div>
        <ul class="flex flex-row gap-x-3">
            <li><a href="{{ route('home') }}" class=" px-8 py-4 text-base font-semibold">
                    Home /
                </a></li>
            <li><a href="#" class=" px-8 py-4 text-base font-semibold">
                    Mentor Profile
                </a></li>
        </ul>
    </div>
    <div class="p-8 border items-center flex flex-row gap-x-4">
        <a href="#">
            <img src="{{ $mentor->user->image }}" alt="" class="object-cover w-[100px] h-[100px] bg-red-100 rounded-full">
        </a>
        <div class="flex flex-col gap-y-2 items-left">
            <a href="#">
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
    <div class="grid grid-cols-3 gap-x-5">
        <div class="col-span-2 flex flex-col gap-y-10">
            <div class="flex flex-col gap-y-3">
                <h3 class="text-lg font-bold text-indigo-950">
                    About
                </h3>
                <article class="text-base tight-loose">
                    {!! $mentor->about !!}
                </article>
            </div>
            <div class="flex flex-col gap-y-3">
                <h3 class="text-lg font-bold text-indigo-950">
                    Portfolio
                </h3>
                <p class="text-base tight-loose">
                    Explore the portfolios of mentors who can unlock your true potential.
                </p>
                <div class="grid grid-cols-2 gap-x-5 gap-y-5">
                    @forelse ($mentor->user->portfolios as $portfolio)
                    <div class="col-span-1">
                        <img src="{{ $portfolio->link }}" alt="{{ $mentor . '\'s portfolio' }}" class="object-cover w-full h-[200px]">
                    </div>
                    @empty
                    <div>No portfolios can be shown.</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="booking-section p-8 border flex flex-col gap-y-4">
                <h3 class="text-xl text-indigo-950 font-bold">
                    Booking Mentor
                </h3>
                <p class="text-sm text-indigo-950">
                    {{ 'Rp. ' . number_format($mentor->price_per_hour) . '/hour' }}
                </p>
                <form method="POST" action="{{ route('checkout', $mentor->user->username) }}">
                    @csrf
                    <div class="mb-4">
                        <p class="text-sm text-indigo-950">
                            How many hours?
                        </p>
                        <input 
                            type="number" 
                            name="hours" 
                            id="hours" 
                            min=1
                            max=1000
                            value="{{ old('hours', 1) }}"
                            required
                            autofocus
                            class="border-0 w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base @error('hours') border border-red-500 @enderror"
                        >
                        @error('hours')
                            <div class="text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-indigo-950">
                            Choose date
                        </p>
                        <input 
                            type="date" 
                            name="date" 
                            id="date" 
                            value="{{ old('date', date('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}"
                            class="border-0 w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base @error('date') border border-red-500 @enderror"
                        >
                        @error('date')
                            <div class="text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <p class="text-sm text-indigo-950">
                            Choose time
                        </p>
                        <select 
                            name="time" 
                            id="time" 
                            class="border-0 w-full px-4 py-3 bg-slate-100 text-indigo-950 text-base @error('time') border border-red-500 @enderror"
                        >
                            <option value="">Choose hours and date first...</option>
                        </select>
                        @error('time')
                            <div class="text-red-500">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-slate-300 px-8 py-4 text-base font-semibold">
                        @auth 
                            Proceed to Checkout 
                        @else 
                            Sign In to Checkout 
                        @endauth
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('after-scripts')
<script>
    // Set minimum date for #date element
    // var today = new Date();
    // var formattedDate = today.getFullYear() + "-" + String(today.getMonth() + 1).padStart(2, '0') + "-" + String(today.getDate()).padStart(2, '0');
    // $("#date").attr("min", formattedDate);

    // Get mentor username from data attribute
    var mentorUsername = "{{ $mentor->user->username }}";

    async function getAvailableTime() {
        var hours = $("#hours").val();
        var date = $("#date").val();

        try {
            const response = await fetch(`/${mentorUsername}/available-time/${date}/${hours}`);
            const json = await response.json();

            if (json.success) {
                var html = "";
                var defaultHour = "9";

                for (const [key, value] of Object.entries(json.data.times)) {
                    var isSelected = "";
                    if (key === defaultHour) isSelected = "selected";
                    html += `<option value="${key}" ${isSelected}>${value}</option>`;
                }

                $("#time").html(html);
            }
        } catch (error) {
            console.error(error);
        }
    }

    // Change event handler for #date and #hours elements
    $("#date, #hours").on("change", getAvailableTime());

    $(document).ready(function () {
        getAvailableTime();
    });
</script>
@endsection