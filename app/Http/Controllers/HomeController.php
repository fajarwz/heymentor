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
            'slug' => null,
            'name' => 'All Roles',
        ];
        $titles = Title::all()->toArray();

        $titles = [
            $allTitle,
            ...$titles,
        ];

        $mentors = Mentor::with('user');

        if ($request->title) {
            $mentors->whereHas('title', function ($query) use ($request) {
                $query->where('slug', $request->title);
            });
        }

        return view('pages.home', [
            'titles' => $titles,
            'mentors' => $mentors->paginate(1),
            'currentTitle' => $request->title,
        ]);
    }
}
