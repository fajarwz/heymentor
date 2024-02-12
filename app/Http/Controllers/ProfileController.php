<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Mentor;
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

    public function getAvailableTime($username, $date, $time) {

        $time = [
            0 => '12:00 AM',
            1 => '01:00 AM',
            2 => '02:00 AM',
            3 => '03:00 AM',
            4 => '04:00 AM',
            5 => '05:00 AM',
            6 => '06:00 AM',
            7 => '07:00 AM',
            8 => '08:00 AM',
            9 => '09:00 AM',
            10 => '10:00 AM',
            11 => '11:00 AM',
            12 => '12:00 PM',
            13 => '01:00 PM',
            14 => '02:00 PM',
            15 => '03:00 PM',
            16 => '04:00 PM',
            17 => '05:00 PM',
            18 => '06:00 PM',
            19 => '07:00 PM',
            20 => '08:00 PM',
            21 => '09:00 PM',
            22 => '10:00 PM',
            23 => '11:00 PM',
        ];

        $mentor = User::where('username', $username)->first();

        if (!$mentor) {
            return response()->json([
                'success' => false,
                'message' => 'Mentor not found.',
                'data' => [],
            ]);
        }
        
        $bookingTimes = Booking::where('mentor_user_id', $mentor->id)
            ->where('date', $date)
            ->pluck('time');

        // $bookingTimes
    }
}
