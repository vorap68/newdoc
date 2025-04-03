<?php

namespace App\Actions\History;

use App\Models\History;
use Illuminate\Support\Facades\DB;

class GetUniqueUsers
{
    public function handle()
    {
        $histories_users = collect(DB::select("SELECT * FROM histories JOIN(
              SELECT origin_name, MAX(created_at) as late_created FROM histories GROUP BY origin_name) AS latest
              ON histories.origin_name = latest.origin_name
              AND histories.created_at = latest.late_created"));

        $histories_users = $histories_users->map(function($user){
            return new History((array) $user);
        }); 
        return $histories_users;
    }
}
