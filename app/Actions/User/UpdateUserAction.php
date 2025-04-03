<?php

namespace App\Actions\User;

use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;

class UpdateUserAction
{
    public function handle(Request $request,User $user)
    {
        try {
            $before = $user->toArray();
           $user->update($request->all());
           $user->save();
           History::updateLog($before,$user);
           return true;
        } catch (\Throwable $th) {
            return false;
        }
        dd($request->all());
    }
}