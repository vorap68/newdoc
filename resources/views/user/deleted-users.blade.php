@extends('layouts.app')

@section('title', 'deleted_users')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Origin_name</th>
               
                <th scope="col">Restore</th>
                <th scope="col">MassRestore</th>
               
              

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $user->origin_name }}</td>
                   
                    <td>
                        <a href="{{ route('users.restore',$user->id ) }}" class="btn btn-info">restory</a>
                        {{-- <form action="{{ route('users.restore' ) }}" method="POST">
                            @csrf
                           <input type="submit" class="btn btn-danger" value="restory"></input>
                           <input type="hidden" name="user_id" value="{{$user->id}}"></input>
                        </form> --}}
                    </td>
                  
                    <td>
                        <div class="form-check">
                            <input class="user-restore" type="checkbox" value="{{$user->id}}" 
                                name="massRestory">
                        </div>
                    </td>

                  



                </tr>
            @endforeach


        </tbody>
    </table>

    <button id ="massRestory" class="btn btn-danger"> Restory</button>
    <br>
   
    @endsection
