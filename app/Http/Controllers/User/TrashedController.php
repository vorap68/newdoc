<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrashedController extends Controller
{
    public function index()
    {
       $users = User::onlyTrashed()->get();
        return view('user.deleted-users',compact('users'));
    }

    public function restoreUser($id)
    {
       // dd('7777777777');
        $user = User::withTrashed()->find($id);
       $user->restore();
        return to_route('users.index');
    }

    public function massRestoreUser(Request $request){
        foreach($request->users_ids as $id){
            $user = User::withTrashed()->find($id);
            $user->restore();
        }
        return  response()->json(['restory' => route('users.index')]);
    }
}
