@extends('layouts.app')

@section('title','show')

@section('content')
<div class="card" style="width: 18rem;">

        <div class="card-body">
            
            <h3 class="card-title">Action:{{$action}} </h3>

        </div>
        <div class="card-body">
            <h5 class="card-title">Before </h5>
            @foreach ($before_diff as $key => $item)
                <p class="card-text">{{ $key }}: {{ $item }}</p>
            @endforeach
        </div>


            <div class="card-body">
                <h5 class="card-title">Current</h5>
                @foreach ($current_diff as $key => $item)
                    <p class="card-text">{{ $key }}: {{ $item }}</p>
                @endforeach

            </div>


        @if ($action != 'recovery')
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <br>
                    <a href="{{ route('history.user.recovery', $id) }}">RecoveryUser</a>
                </div>
            </div>
        @endif

  </div>
  @endsection
