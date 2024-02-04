<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Title;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request) {
        $allTitle = [
            'id' => null,
            'name' => 'All Roles',
        ];
        $titles = Title::all()->toArray();

        $titles = [
            $allTitle,
            ...$titles,
        ];

        return view('pages.home', [
            'titles' => $titles,
            'mentors' => Mentor::with('user')->get(),
            'role' => $request->role,
        ]);
    }
}
