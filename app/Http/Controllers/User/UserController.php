<?php

namespace App\Http\Controllers\User;

use App\Models\User;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(UserRequest $request, User $user)
    {
        //dd($request->all());
        $user->update($request->all());
        $user->save();
        return redirect()->back();
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
         return to_route('users.index');
    }

    public function massDel(Request $request)
    {
        foreach($request->users_ids as $id){
            $user = User::find($id);
            $this->destroy($user);
        }
        return response()->json([
            'ids'=>$request->users_ids,
        ]);
    }
    public function massForceDel(Request $request)
    {
        foreach($request->users_ids as $id){
            $user = User::find($id);
            $this->forceDelete($user);
        }
        return response()->json([
            'ids'=>$request->users_ids,
        ]);
    }

    public function forceDelete(User $user)
    {
       
        $user->forceDelete();
        return to_route('users.index');
    }
}
