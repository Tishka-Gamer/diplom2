@extends('admins.layout')
@section('title')
Создание продукта
@endsection
@section('content')

<div>
    <form action="{{Route('addprod')}}" enctype="multipart/form-data" method="POST">
        @csrf
        @if (isset($exseption))
        <div>
            <p>{{$exseption}}</p>
        </div>
        @endif
        <div>
            <img src="" alt="">
            <input type="file" name="photo">
        </div>
        <div class="red-prod">
            <label for="name">Наименование</label>
            <input type="text" id="name" name="name">
            <br>
            <label for="count">Количество</label>
            <input type="number" id="count" name="count">
            <br>
            <label for="">Цена</label>
            <input type="number" id="price" name="price">
            <br>
            <label for="description">Описание</label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            <br>
            <label for="structure">Состав</label>
            <textarea name="structure" id="structure" cols="30" rows="10"></textarea>
            <br>
            <label for="callories">Калорийность</label>
            <input type="text" id="callories" name="callories">
            <br>
            <label for="bgu">БЖУ</label>
            <input type="text" id="bgu" name="bgu">
            <br>
            <label for="cat">Категория</label>
            <select name="cat" id="cat">
                @foreach ($categories as $category)
                <option value="{{$category->id}}" >{{$category->name}}</option>
                @endforeach
            </select>
            <br>
            <button name="btn" value="1">Создать</button>
        </div>
    </form>
</div>
@endsection
