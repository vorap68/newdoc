<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->filled('last_name')) {
            $user = User::where('last_name', $request->input('last_name'))->get();
        };

        if ($request->filled('first_name')) {
            $user = User::where('first_name', $request->first_name)->get();
        };

        if ($request->filled('email')) {
            $user = User::where('email', $request->email)->get();
        };
        $users = collect($user);

        return view('user.index', compact('users'));
    }
}
