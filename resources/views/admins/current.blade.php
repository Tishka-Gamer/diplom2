@extends('admins.layout')
@section('title')
Статус
@endsection
@section('content')
<div>
    <form action="/addcurrent" method="POST">
        @csrf
        <label for="prod">Введите несколько символов из названия продукта</label>
        <input type="text" list="prods" name="prod" id="prod">
        <datalist id="prods">
            @foreach ($products as $prod)
            <option value="{{$prod->name}}">{{$prod->id}}</option>
            @endforeach
        </datalist>
        {{-- <select name="product" id="product">
            @foreach ($products as $prod)
            <option value="{{$prod->id}}">{{$prod->name}}</option>
            @endforeach
        </select> --}}
        <button type="submit">Добавить</button>
    </form>
</div>
<div>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">наименование продукта</th>
            <th scope="col">удалить</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($currents as $current)
            <tr>
                <th scope="row">{{$current->pr_id}}</th>
                <td class="profil-p" data-review-content="{{$current->name}}" id="reviewContent-{{ $current->pr_id }}">{{$current->name}}</td>
                <td><form action="{{Route('delcurrent')}}" method="POST">@csrf
                        @method('DELETE')<button type="submit" class="btn btn-primary" name="id" value="{{$current->id}}">Удалить</button></form></td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>

@endsection
