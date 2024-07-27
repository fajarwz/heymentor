<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Http\Requests\CheckoutRequest;
use App\Models\Booking;
use App\Models\Mentor;
use App\Models\Setting;
use App\Notifications\InvoicePending;
use App\Services\Midtrans\NotificationService as MidtransNotificationService;
use App\Services\Midtrans\Midtrans;
use App\Services\Midtrans\SnapTokenService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function checkout($username, CheckoutRequest $request) {
        $mentor = Mentor::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->first();

        $isBookingConflict = $this->isBookingConflict($mentor, $request);
        if ($isBookingConflict) {
            abort(403, 'Booking time is not available');
        }

        $setting = Setting::first();
        $date = Carbon::parse($request->date);
        $startDateTime = $date->clone()->setHour((int) $request->time)->startOfHour();
        $endDateTime = $date->clone()->setHour((int) $request->time + (int) $request->hours)->startOfHour();

        $priceAfterHours = $mentor->price_per_hour * $request->hours;
        $careerInsuranceCost = $setting->career_insurance_cost;
        $addOnToolsCost = $setting->add_on_tools_cost;

        $total = $priceAfterHours + $careerInsuranceCost + $addOnToolsCost;
        $taxCost = $total * ($setting->tax_percent / 100);
        $grandTotal = $total + $taxCost;

        $booking = auth()->user()->bookings()->create([
            'mentor_user_id' => $mentor->user->id,
            'start_date_time' => $startDateTime,
            'end_date_time' => $endDateTime,
            'price_after_hours' => $priceAfterHours,
            'tax_cost' => $taxCost,
            'career_insurance_cost' => $careerInsuranceCost,
            'add_on_tools_cost' => $addOnToolsCost,
            'grand_total' => $grandTotal,
            'status' => BookingStatus::STATUS_PENDING,
        ]);

        $paymentRoute = route('checkout.show', [$username, $booking->id]);

        auth()->user()->notify(new InvoicePending($paymentRoute));

        return redirect()->to($paymentRoute);
    }

    private function isBookingConflict($mentor, $request) {
        $date = Carbon::parse($request->date);
        $startDateTime = $date->clone()->setHour((int) $request->time)->startOfHour();
        $endDateTime = $date->clone()->setHour((int) $request->time + (int) $request->hours)->startOfHour();

        return Booking::where('mentor_user_id', $mentor->user->id)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where(function ($q) use ($startDateTime, $endDateTime) {
                    $q->where('start_date_time', '<', $endDateTime)
                        ->where('end_date_time', '>', $startDateTime);
                });
            })->exists();
    }

    public function show($username, $bookingId, Request $request) {
        $mentor = Mentor::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->first();

        $booking = auth()->user()->bookings()->where('id', $bookingId)->first();

        $setting = Setting::first();

        $snapTokenService = new SnapTokenService($booking, auth()->user());
        $snapToken = $snapTokenService->getSnapToken();

        return view('pages.checkout', [
            'mentor' => $mentor,
            'booking' => $booking,
            'setting' => $setting,
            'snapToken' => $snapToken,
            'clientKey' => config('midtrans.client_key'),
        ]);
    }

    public function success(Request $request) {
        $booking = auth()->user()->bookings()->where('id', $request->order_id)->firstOrFail();
        if ($booking->status !== BookingStatus::STATUS_APPROVED) {
            abort(404);
        }

        return view('pages.checkout-success', [
            'mentorUser' => $booking->mentorUser,
        ]);
    }

    public function notification() {        
        $midtransNotificationService = new MidtransNotificationService(new Booking);

        $notification = $midtransNotificationService->getNotification();
        $booking = $midtransNotificationService->getOrder();

        $this->updateTransactionStatus($notification, $booking);

        return response()->json([
            'status' => 'success',
        ]);
    }

    private function updateTransactionStatus($notification, $booking) {
        if ($notification->isSuccess()) {
            $booking->update(['status' => BookingStatus::STATUS_APPROVED]);
        } 
        else if ($notification->isChallenge()) {
            $booking->update(['status' => BookingStatus::STATUS_CHALLENGE]);
        } 
        else if ($notification->isPending()) {
            $booking->update(['status' => BookingStatus::STATUS_PENDING]);
        } 
        else {
            $booking->update(['status' => BookingStatus::STATUS_REJECTED]);
        }
    }
}
