@extends('admins.layout')
@section('title')
Редактирование продукта
@endsection
@section('content')

<div>
    <form action="{{Route('redprod')}}" enctype="multipart/form-data" method="POST">
        @csrf
        @if (isset($exseption))
        <div>
            <p>{{$exseption}}</p>
        </div>
        @endif
        <div>
            <img width="500px"  src="/image/{{$product->photo}}" alt="{{$product->photo}}">
            <input name="photo" type="file">
        </div>
        <div class="red-prod">
            <div class="mb-3">
                <label class="form-label" for="name">Название продукта</label>
                <input type="text" class="form-control" id="name" value="{{$product->name}}" name="name">
            </div>
            <div class="mb-3">
                <label for="count">Цена</label>
                <input type="number" class="form-control" value="{{$product->count}}" id="count" name="count">
            </div>
            <div class="mb-3">
                <label class="form-label" for="price">Стоимость</label>
                <input type="number" class="form-control" id="price" value="{{$product->price}}" name="price">
            </div>
            <div class="mb-3">
                <label class="form-label" for="description">Описание</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{$product->description}}</textarea>
            </div>
            <div class="mb-3">
                <labe class="form-label"l for="structure">Состав</labe>
                <textarea name="structure" class="form-control" id="structure" cols="30" rows="10">{{$product->structure}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label" for="callories">Каллорийность</label>
                <input type="text" class="form-control" id="callories" name="callories" value="{{$product->callories}}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="bgu">БЖУ</label>
                <input type="text" class="form-control" id="bgu" name="bgu" value="{{$product->bgu}}">
            </div>
            <div class="mb-3">
                <select class="form-control" name="cat" id="">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="photoi" value="{{$product->photo}}">
            <button name="btn" type="submit" class="btn btn-primary " value="{{$product->id}}">Изменить</button>
        </div>
    </form>

</div>

@endsection
