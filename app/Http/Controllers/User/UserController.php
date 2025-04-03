<?php

namespace App\Http\Controllers\User;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\ForceDeleteAction;
use App\Actions\User\MassDeleteUserAction;
use App\Actions\User\MassForceDeleteAction;
use App\Actions\User\UpdateUserAction;
use App\Models\User;
use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$users = User::withTrashed()->get();
        $users = User::all();
      return view('user.index',compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user, UpdateUserAction $update_user)
    {
        $success = $update_user->handle($request, $user);
        if(!$success){
            return redirect()->back()->with('error','User wasn`t updated');
           }
           return redirect()->back();
            }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, DeleteUserAction $delete_user)
    {
       $success = $delete_user->handle($user);
       if(!$success){
        return redirect()->back()->with('error','User wasn`t deleted');
       }
         return to_route('users.index');
    }

    public function massDel(Request $request, MassDeleteUserAction $mass_delete_user)
    {
       $success = $mass_delete_user->handle($request->users_ids);
       if(!$success){
        return response()->json(['message'=>'Users weren`t deleted'],500);
       }
       
        return response()->json([
            'ids'=>$request->users_ids,
        ]);
    }
   

    public function forceDelete(User $user,ForceDeleteAction $force_delete)
    {  
        $success = $force_delete->handle($user);
        if(!$success){
            return redirect()->back()->with('error','User wasn`t forseDeleted');
        }
        
         return to_route('users.index');
    }


    public function massForceDel(Request $request,MassForceDeleteAction $mass_force_delete)
    {
       $success = $mass_force_delete->handle($request->users_ids);
        if(!$success){
            return response()->json(['message'=>'Users weren`t deleted'],500);
           }

        return response()->json([
            'ids'=>$request->users_ids,
        ]);
    }
}
