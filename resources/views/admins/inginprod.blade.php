@extends('admins.layout')
@section('title')
Ингридиенты у продуктов
@endsection
@section('content')
<div>
    <form action="{{Route('addingprod')}}">
        <label for="ing">Выберите ингридиент</label>
        <select name="ing" id="ing">
            @foreach ($ings as $ing)
            <option value="{{$ing->id}}">{{$ing->name}}</option>
            @endforeach
        </select>
        <label for="price">Выберите продукт</label>
        <select name="product" id="">
            @foreach ($products as $product)
            <option value="{{$product->id}}">{{$product->name}}</option>
            @endforeach
        </select>
        <button type="submit">Создать</button>
    </form>
</div>
<div>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Продукт</th>
            <th scope="col">Ингридиент</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Удалить</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->product}}</td>
                <td>{{$item->ingridident}}</td>
                <td><form action="{{Route('redingprod')}}"><button class="btn btn-primary " type="submit" value="{{$item->id}}">red</button></form></td>
                <td><form action="{{Route('delingprod')}}"><button  class="btn btn-primary " name="id" type="submit" value="{{$item->id}}">del</button></form></td>
              </tr>
            @endforeach

        </tbody>
      </table>
</div>

@endsection
