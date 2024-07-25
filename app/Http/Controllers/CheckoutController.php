<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Http\Requests\CheckoutRequest;
use App\Models\Booking;
use App\Models\Mentor;
use App\Models\Setting;
use App\Notifications\InvoicePending;
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
            return abort(403, 'Booking time is not available');
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
        $this->setUpMidtransConfig();

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
        if ($booking->status !== BookingStatus::STATUS_APPROVED) {
            return abort(404);
        }

        return view('pages.checkout-success', [
            'mentorUser' => $booking->mentorUser,
        ]);
    }

    public function notification() {        
        $this->setUpMidtransConfig();

        try {
            $notif = new \Midtrans\Notification();
        }
        catch (\Exception $e) {
            exit($e->getMessage());
        }

        $notif = $notif->getResponse();

        // info(json_encode($notif));

        $order = Booking::findOrFail($notif->order_id);

        if (!$this->isSignatureKeyVerified($notif, $order)) {
            return abort(403, 'Invalid signature');
        }

        $this->updateTransactionStatus($notif, $order);

        return response()->json([
            'status' => 'success',
        ]);
    }

    private function isSignatureKeyVerified($notif, $order) {
        return $this->createSignatureKey($notif, $order) === $notif->signature_key;
    }

    private function createSignatureKey($notif, $order) {
        $orderId = $order->id;
        $statusCode = $notif->status_code;
        $grossAmount = number_format($order->grand_total, 2, '.', '');

        $serverKey = env('MIDTRANS_SERVER_KEY');

        $signatureBuilder = $orderId . $statusCode . $grossAmount . $serverKey;
        // info($signatureBuilder);
        $signature = openssl_digest($signatureBuilder, 'sha512');

        return $signature;
    }

    private function updateTransactionStatus($notif, $order) {
        if ($notif->transaction_status == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($notif->payment_type == 'credit_card') {
                if ($notif->fraud_status == 'challenge') {
                    $order->update(['status' => BookingStatus::STATUS_CHALLENGE]);
                } else {
                    $order->update(['status' => BookingStatus::STATUS_APPROVED]);
                }
            }
        } else if ($notif->transaction_status == 'settlement') {
            $order->update(['status' => BookingStatus::STATUS_APPROVED]);
        } else if ($notif->transaction_status == 'pending') {
            $order->update(['status' => BookingStatus::STATUS_PENDING]);
        } else {
            $order->update(['status' => BookingStatus::STATUS_REJECTED]);
        }
    }

    private function setUpMidtransConfig() {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');
    }
}
