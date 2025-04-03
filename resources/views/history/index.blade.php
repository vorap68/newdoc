@extends('layouts.app')

@section('title', 'history_users')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Origin_name</th>
                <th scope="col">Last action</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @isset($users_history)
                
          
            @foreach ($users_history as $user)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $user->origin_name }}</td>
                    <td>{{ $user->action }}</td>
                    <td>
                        <a href="{{ route('history.detail', $user->id) }}" class="btn btn-warning">Detail</a>
                    </td>
                    
                </tr>
            @endforeach
            @endisset
        </tbody>
    </table>

   
@endsection
