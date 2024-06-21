@extends('admins.layout')
@section('title')
Продукты
@endsection
@section('content')

<div>
    <h3 style="text-align: center;">Отзывы требующие модерации</h3>
    <table class="table  table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">пользователь</th>
            <th scope="col">текст</th>
            <th scope="col">Продукт</th>
            <th scope="col">дата написания</th>
            <th scope="col">дата редактирования </th>
            <th scope="col">удалить</th>
            <th scope="col">Прошел модерацию</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($reviewshid as $review)
            <tr>
                <th scope="row">{{$review->id}}</th>
                <td>{{$review->user}}</td>
                <td class="profil-p" data-review-content="{{$review->text}}" id="reviewContent-{{ $review->id }}">{{$review->text}}</td>
                <td><form action="/show"><button name="id" class="review-prod" value="{{$review->product_id}}">{{$review->product}}</button></form></td>
                <td>{{\Carbon\Carbon::parse($review->created_at)->format('d.m.Y')}}</td>
                <td>{{\Carbon\Carbon::parse($review->updated_at)->format('d.m.Y')}}</td>
                <td><form action="{{Route('delreview')}}"><button name="id" type="submit" value="{{$review->id}}">del</button></form></td>
                <td><form action="{{Route('reportnone')}}"><button name="id" type="submit" value="{{$review->id}}">Все хорошо</button></form></td>
              </tr>
            @endforeach
        </tbody>
      </table>
      <h3 style="text-align: center;">Все отзывы</h3>
    <table class="table  table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">пользователь</th>
            <th scope="col">текст</th>
            <th scope="col">Продукт</th>
            <th scope="col">дата написания</th>
            <th scope="col">дата редактирования </th>
            <th scope="col">удалить</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
            <tr>
                <th scope="row">{{$review->id}}</th>
                <td>{{$review->user}}</td>
                <td class="profil-p" data-review-content="{{$review->text}}" id="reviewContent-{{ $review->id }}">{{$review->text}}</td>
                <td><form action="/show"><button name="id" class="review-prod" value="{{$review->product_id}}">{{$review->product}}</button></form></td>
                <td>{{\Carbon\Carbon::parse($review->created_at)->format('d.m.Y')}}</td>
                <td>{{\Carbon\Carbon::parse($review->updated_at)->format('d.m.Y')}}</td>
                <td><form action="{{Route('delreview')}}"><button class="btn btn-primary " name="id" type="submit" value="{{$review->id}}">del</button></form></td>
              </tr>
            @endforeach
        </tbody>
      </table>
    </div>
</div>

@endsection

