@extends('layouts.app')

@section('title', 'list')

@section('content')
<form id="filterForm" method="POST" action="{{ route('users.search') }}">

  <input type="text" name="first_name" placeholder="Поиск по имени" value="{{ request('first_name') }}">
  <input type="text" name="last_name" placeholder="Поиск по фамилии" value="{{ request('last_name') }}">
  <input type="text" name="email" placeholder="Поиск по email" value="{{ request('email') }}">

  <button type="submit">Поиск</button>
</form>
<form action="{{route('users.sort')}}" method="POST">
  @csrf
  <select name="sort">
    <option value="first_name" {{ request('sort') == 'first_name' ? 'selected' : '' }}>Имя</option>
    <option value="last_name" {{ request('sort') == 'last_name' ? 'selected' : '' }}>Фамилия</option>
    <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
</select>

<!-- Поле выбора порядка сортировки -->
<select name="order">
    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>По убыванию</option>
</select>
<button type="submit">Сортировка</button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First_name</th>
                <th scope="col">Last_name</th>
                <th scope="col">Email</th>
                <th scope="col">Show</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
               
                <th scope="col">MassDelete</th>
                <th scope="col">ForceDelete</th>
                <th scope="col">MassForceDelete</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="{{ route('users.show', $user->id) }}">show</a></td>
                    <td><a href="{{ route('users.edit', $user->id) }}">edit</a></td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="btn btn-danger" value="delete"></input>
                        </form>
                    </td>
                  
                    <td>
                        <div class="form-check">
                            <input class="user-del" type="checkbox" value="{{$user->id}}" id="massDelete"
                                name="massDelete">
                        </div>
                    </td>

                    <td>
                      <form action="{{ route('users.force-delete', $user->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <input type="submit" class="btn btn-danger" value="force-delete"></input>
                      </form>
                  </td>
                    <td>
                        <div class="form-check">
                            <input class="user-forcedel" type="checkbox" value="{{$user->id}}" id="massForceDelete"
                                name="massForceDelete">
                        </div>
                    </td>



                </tr>
            @endforeach


        </tbody>
    </table>

    <button id ="massDel" class="btn btn-danger"> Delete</button>
    <br>
    <br>
    <button id ="massForceDel" class="btn btn-danger"> ForceDelete</button>
@endsection
