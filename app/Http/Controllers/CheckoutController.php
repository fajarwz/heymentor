<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show($username, Request $request) {
        $mentor = Mentor::whereHas('user', function ($query) use ($username) {
            $query->where('username', $username);
        })->first();

        return view('pages.profile', [
            'mentor' => $mentor,
        ]);
    }
}
