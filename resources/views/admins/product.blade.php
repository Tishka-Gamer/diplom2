@extends('admins.layout')
@section('title')
Продукты
@endsection
@section('content')
<div>
    <form action="{{Route('addp')}}">
        <button type="submit">Создать товар</button>
    </form>
    <div style="width: 500px;">
        <label for="search" class="form-label">Введите название продукта</label>
        <input type="text" class="form-control" id="search" placeholder="Введите хотя бы несколько символов">
    </div>
</div>
<div>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">фото</th>
            <th scope="col">наименование</th>
            <th scope="col">остаток</th>
            <th scope="col">цена</th>
            <th scope="col">описание</th>
            <th scope="col">состав</th>
            <th scope="col">калорийность</th>
            <th scope="col">бжу</th>
            <th scope="col">категория</th>
            <th scope="col">редактировать</th>
            <th scope="col">удалить</th>
          </tr>
        </thead>
        <tbody id="results-body">
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{$product->id}}</th>
                <td><img src="/image/{{$product->photo}}" width="100px" height="100px" alt="{{$product->photo}}"></td>
                <td>{{$product->name}}</td>
                <td>{{$product->count}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->description}}</td>
                <td>{{$product->structure}}</td>
                <td>{{$product->callories}}</td>
                <td>{{$product->bgu}}</td>
                <td>{{$product->category}}</td>
                <td><form action="{{Route('redp')}}"><button class="btn btn-primary " name="btn" value="{{$product->id}}">red</button></form></td>
                <td><form action="{{Route('delprod')}}"><button class="btn btn-primary " name="id" type="submit" value="{{$product->id}}">del</button></form></td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>

@endsection
@section('script')
<script src="/js/product.js"></script>

@endsection
