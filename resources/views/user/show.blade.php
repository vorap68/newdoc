@extends('layouts.app')

@section('title','show')

@section('content')
<div class="card" style="width: 18rem;">
    
    <div class="card-body">
      <h5 class="card-title">{{$user->first_name}}</h5>
      <h5 class="card-title">{{$user->last_name}}</h5>
      <h5 class="card-title">{{$user->middle_name}}</h5>
      <h5 class="card-title">{{$user->email}}</h5>
      <h5 class="card-title">{{$user->phone}}</h5>
   
      <a href="{{route('users.index')}}" class="btn btn-primary">Return to list of users</a>
    </div>
  </div>
  @endsection