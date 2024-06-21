@extends('admins.layout')
@section('title')
Категории
@endsection
@section('content')

<div>
    <div>
        <form action="{{Route('addadmin')}}" method="post">
            @csrf
            <label for="name">Логин</label>
            <input type="text" name="name" id="name">
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password">
            <button name="btn">Создать</button>
        </form>
    </div>
    <div>

       <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr>
                    <th scope="row">{{$admin->id}}</th>
                    <td>{{$admin->name}}</td>
                    <td><form action="{{Route('deladmin')}}" method="POST">@csrf
                        @method('DELETE')<button name="id" class="btn btn-primary " type="submit" value="{{$admin->id}}">del</button></form></td>
                </tr>
                @endforeach

            </tbody>
      </table>
    </div>
</div>

@endsection
