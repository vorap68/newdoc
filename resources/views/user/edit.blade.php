@extends('layouts.app')

@section('title','edit')

@section('content')
<form action="{{route('users.update',$user->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="first_name" class="form-label">first_name</label>
      <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}">
     </div>
    <div class="mb-3">
      <label for="last_name" class="form-label">last_name</label>
      <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}">
     </div>
    <div class="mb-3">
      <label for="middle_name" class="form-label">middle_name</label>
      <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{$user->middle_name}}">
     </div>
    <div class="mb-3">
      <label for="Email" class="form-label">Email</label>
      <input type="email" class="form-control" id="Email" name="Email" value="{{$user->email}}">
     </div>
    <div class="mb-3">
      <label for="phone" class="form-label">phone</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
     </div>
 
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection
