@extends('layouts.app')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First_name</th>
                <th scope="col">Email</th>
                <th scope="col">Show</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
                <th scope="col">ForceDelete</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="{{ route('users.show', $user->id) }}">show</a></td>
                    <td><a href="{{ route('users.edit', $user->id) }}">edit</a></td>
                    <td><a href="{{ route('users.destroy', $user->id) }}">delete</a></td>
                    <td><a href="{{ route('users.destroy', $user->id) }}">forceDelete</a></td>

                </tr>
            @endforeach


        </tbody>
    </table>
@endsection
