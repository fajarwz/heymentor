<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mentor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($username) {
        $mentor = Mentor::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->first();

        return view('pages.profile', [
            'mentor' => $mentor,
        ]);
    }

    public function getAvailableTime($username, $date, $hours) {
        if (!$date || $hours === '') {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request.',
            ]);
        }

        $startHour = 0;
        $endHour = 23;

        $availableTimes = [];

        $mentor = User::where('username', $username)->first();
        $date = Carbon::parse($date);

        for ($hour = $startHour; $hour <= $endHour; $hour++) {
            $startTime = $date->clone()->setHour($hour)->startOfHour();
            $endTime = $date->clone()->setHour($hour + ($hours - 1))->endOfHour();

            // Check if any booking conflicts with this time slot
            $conflictingBooking = Booking::where('mentor_user_id', $mentor->id)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->where(function ($q) use ($startTime, $endTime) {
                        $q->where('start_date_time', '<', $endTime)
                          ->where('end_date_time', '>', $startTime);
                    });
                })->exists();

            // If no conflict, add the time slot to available times
            if (!$conflictingBooking) {
              $availableTimes[$hour] = $startTime->format('g:i A');
            }
          }

        return response()->json([
            'success' => true,
            'message' => '',
            'data' => [
                'times' => $availableTimes,
            ],
        ]);
    }
}
