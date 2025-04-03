<?php

namespace App\Actions\User;

use App\Models\History;
use App\Models\User;

class MassForceDeleteAction
{
     public function handle($users_ids)
     {
        try {
           foreach($users_ids as $id){
            $user = User::find($id);
            History::forceDeleteLog($user->toArray());
            $user->forceDelete();
           } 
           return true;
        } catch (\Exception $e) {
           return false;
        }
     }
}