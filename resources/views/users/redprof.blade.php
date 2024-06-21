@extends('layouts.layout')
@section('title')
Редактирование профиля
@endsection
@section('content')
<div>
    <br>
    <br>
    <form action="/redprofil" class="redprfr" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="form-label">ФИО</label>
            <input type="text" class="form-control" name="name" id="name" minlength="15" maxlength="20" pattern="^[^<>\[\]\\\/]*$" value="{{$user->name}}" placeholder="введите имя">
        </div>
        <div class="mb-4">
            <label for="number" class="form-label">Номер</label>
            <input type="text" name="number" class="form-control" id="number" pattern="^8\d{10}$" value="{{$user->number}}" placeholder="введите телефон в формате 8xxxxxxxxxx">
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Почта</label>
            <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}" placeholder="введите почту">
        </div>
        <Button class="btn" type="submit">Изменить</Button>
    </form>
</div>
@endsection
