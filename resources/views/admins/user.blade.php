@extends('admins.layout')
@section('title')
Пользователь
@endsection
@section('content')

<div>
    <table class="table  table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ФИО</th>
            <th scope="col">номер</th>
            <th scope="col">почта</th>
            <th scope="col">Удалить</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->number}}</td>
                <td>{{$user->email}}</td>
                <td><form action="{{Route('deling')}}"><button class="btn btn-primary" name="id" type="submit" value="{{$user->id}}">del</button></form></td>
              </tr>
            @endforeach

        </tbody>
      </table>
</div>

@endsection
