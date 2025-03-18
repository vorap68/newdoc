<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SortController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $field = $request->sort ?? 'name'; // Если поле не указано, используем 'name'
        $order = $request->order === 'desc' ? 'desc' : 'asc';
        $users = User::orderBy($field, $order)->paginate(10);
        return view('user.index', compact('users'));
    }
}
