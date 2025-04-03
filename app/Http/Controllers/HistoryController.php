<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\History;
use Illuminate\Support\Arr;
use App\Actions\History\GetUniqueUsers;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryController extends Controller
{
    use SoftDeletes; 

    public function index(GetUniqueUsers $get_unique_users)
    {
        $users_history = History::all();
        return view('history.index', compact('users_history'));
    }

    public function detail($id)
    {
        $history_user  = History::find($id);
        $action = $history_user->action;
        $origin_name = $history_user->origin_name;
        $current = json_decode($history_user->current,true);
        $before = json_decode($history_user->before,true);
        
        $current = Arr::except($current,['id', 'updated_at', 'created_at',  'email_verified_at','password','origin_name']);
        //dump($current);
        $before = Arr::except($before,['id', 'updated_at', 'created_at',  'email_verified_at','password','origin_name']);
       // dd($before);
       if($history_user->action = 'forceDelete'){
        $current =[];
       } 
        $current_diff = array_diff_assoc($current,$before);
        $before_diff = array_diff_assoc($before,$current);
        return view('history.detail',compact('current_diff','before_diff','action','id'));
    }

    public function recovery($id)
    {
        $history_user = History::find($id);
        $before = json_decode($history_user->before,true);
             unset($before['created_at']);
        unset($before['updated_at']);
        unset($before['email_verified_at']);
        User::updateOrInsert(['id' => $history_user->user_id_stable],$before);
        $history_user->delete();
        return to_route('users.index');
             
    }
}
