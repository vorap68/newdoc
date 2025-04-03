<?php

namespace App\Actions\User;

use App\Models\User;
use App\Models\History;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;

class ForceDeleteAction
{

    public function handle(User $user)
    {
        try {
           DB::transaction(function () use($user) {
            History::forceDeleteLog($user->toArray());
            $user->forceDelete();
           });
           return true;
        } catch (\Throwable $th) {
           return false;
        }
    }
}