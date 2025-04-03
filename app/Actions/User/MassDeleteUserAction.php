<?php
namespace App\Actions\User;

use App\Models\History;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MassDeleteUserAction
{
    public function handle($users_ids)
    {
       
        try {
            DB::transaction(function () use($users_ids) {
                foreach ($users_ids as $id) {
                    $user = User::find($id);
                    $before = $user->toArray();
                    History::deleteLog($before);
                    $user->delete();
                }
            });
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
