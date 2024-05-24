<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mentor;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkout($username, Request $request) {
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

        return redirect()->route('checkout.show', [$username, $booking->id]);
    }

    public function show($username, $bookingId, Request $request) {
        $mentor = Mentor::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->first();

        $booking = auth()->user()->bookings()->where('id', $bookingId)->first();

        $setting = Setting::first();

        return view('pages.checkout', [
            'mentor' => $mentor,
            'booking' => $booking,
            'setting' => $setting,
        ]);
    }

    public function pay($username, Request $request) {
        // 
    }

    public function success($username, Request $request) {
        $mentor = Mentor::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->first();

        return view('pages.checkout-success', [
            'mentor' => $mentor,
        ]);
    }
}
