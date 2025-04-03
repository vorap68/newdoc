<?php

namespace App\Actions\User;


use Exception;
use App\Models\User;
use App\Models\History;
use Illuminate\Support\Facades\DB;

class DeleteUserAction
{
    public function handle(User $user)
    {
        try{
        DB::transaction(function () use($user) {
            $before = $user->toArray();
            History::deleteLog($before);
            $user->delete();
        });
        return true;}
        catch(Exception $e){
            return false;
        }

       
       
    }
}