<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\History;
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
        $user = User::withTrashed()->find($id);
        History::restoreLog($user->toArray());
       $user->restore();
        return to_route('users.index');
    }

    public function massRestoreUser(Request $request){
        foreach($request->users_ids as $id){
           $this->restoreUser($id);
        }
        return  response()->json(['restory' => route('users.index')]);
    }
}
