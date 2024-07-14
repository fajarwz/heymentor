<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Booking;
use App\Models\Mentor;
use App\Models\Setting;
use App\Notifications\InvoicePending;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function checkout($username, CheckoutRequest $request) {
        $mentor = Mentor::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->first();
        $setting = Setting::first();
        $date = Carbon::parse($request->date);

        $priceAfterHours = $mentor->price_per_hour * $request->hours;
        $careerInsuranceCost = $setting->career_insurance_cost;
        $addOnToolsCost = $setting->add_on_tools_cost;

        $total = $priceAfterHours + $careerInsuranceCost + $addOnToolsCost;
        $taxCost = $total * ($setting->tax_percent / 100);
        $grandTotal = $total + $taxCost;

        $booking = auth()->user()->bookings()->create([
            'mentor_user_id' => $mentor->user->id,
            'start_date_time' => $date->clone()->setHour((int) $request->time)->startOfHour(),
            'end_date_time' => $date->clone()->setHour((int) $request->time + (int) $request->hours)->startOfHour(),
            'price_after_hours' => $priceAfterHours,
            'tax_cost' => $taxCost,
            'career_insurance_cost' => $careerInsuranceCost,
            'add_on_tools_cost' => $addOnToolsCost,
            'grand_total' => $grandTotal,
            'status' => Booking::STATUS_PENDING,
        ]);

        $paymentRoute = route('checkout.show', [$username, $booking->id]);

        auth()->user()->notify(new InvoicePending($paymentRoute));

        return redirect()->to($paymentRoute);
    }

    public function show($username, $bookingId, Request $request) {
        $mentor = Mentor::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->first();

        $booking = auth()->user()->bookings()->where('id', $bookingId)->first();

        $setting = Setting::first();

        $snapToken = $this->getMidtransSnapToken($booking);

        return view('pages.checkout', [
            'mentor' => $mentor,
            'booking' => $booking,
            'setting' => $setting,
            'snapToken' => $snapToken,
            'clientKey' => env('MIDTRANS_CLIENT_KEY'),
        ]);
    }

    private function getMidtransSnapToken($booking) {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => $booking->grand_total,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone_number,
            ],
        ];
        
        return \Midtrans\Snap::getSnapToken($params);
    }

    public function success(Request $request) {
        $booking = auth()->user()->bookings()->where('id', $request->order_id)->firstOrFail();
        if ($request->transaction_status === 'settlement') {
            $booking->update(['status' => Booking::STATUS_APPROVED]);
        }

        return view('pages.checkout-success', [
            'mentorUser' => $booking->mentorUser,
        ]);
    }
}
