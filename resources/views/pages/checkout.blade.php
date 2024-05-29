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
    <ul class="flex flex-col gap-y-4">
        <li><a href="#">
                Total hours: <strong>{{ $booking->start_date_time->diffInHours($booking->end_date_time) }} hours</strong>
            </a></li>
        <li><a href="#">
                Date and time: <strong>{{ $booking->start_date_time->format('d M Y') . ' at ' . $booking->start_date_time->format('H.i A') }}</strong>
            </a></li>
        <li><a href="#">
                Price: <strong>{{ 'Rp. ' . number_format($booking->price_after_hours) }}</strong>
            </a></li>
        <li><a href="#">
                Tax {{ $setting->tax_percent . '%' }}: <strong>{{ 'Rp. ' . number_format($booking->tax_cost) }}</strong>
            </a></li>
        <li><a href="#">
                Career insurance: <strong>{{ 'Rp. ' . number_format($booking->career_insurance_cost) }}</strong>
            </a></li>
        <li><a href="#">
                Add on tools: <strong>{{ 'Rp. ' . number_format($booking->add_on_tools_cost) }}</strong>
            </a></li>
        <li><a href="#">
                Grand total: <strong>{{ 'Rp. ' . number_format($booking->grand_total) }}</strong>
            </a></li>
    </ul>
    <div>
        <button type="button" id="pay-button" type="submit" class="py-3 px-5 bg-slate-900 text-white font-bold">
            Pay with Midtrans
        </button>
    </div>
</section>
@endsection

@section('after-scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
    <script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snapToken }}', {
        // Optional
        onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        // Optional
        onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
        });
    };
    </script>
@endsection