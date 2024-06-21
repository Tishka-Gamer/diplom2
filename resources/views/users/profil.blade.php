@extends('layouts.layout')
@section('title')
Профиль
@endsection
@section('content')
<div>
    <div class="prof-cont">
        <div class="prof-c2">
            <div class="prof-user">
                <label for="name">Имя:</label>
                <h1 id="name" name="name">{{$user->name}}</h1>
                <label for="phone">Номер</label>
                <p class="profil-p" id="phone">{{$user->number}}</p>
                <label for="email">Почта</label>
                <p class="profil-p" id="email">{{$user->email}}</p>
            </div>
            <div class="prof-href">
                <h4 style="text-align: center">Важные ссылки:</h4>
                <p class="profil-pa"><a class="profil-a" href="/userorders">Заказы</a></p>
                <p class="profil-pa"><a class="profil-a" href="/userreview">Отзывы</a></p>
                <p class="profil-pa"><a class="profil-a" href="/redprof">Изменить</a></p>
            </div>
        </div>

        @if ($ords != [])
        <p class="profil-p" style="text-align: center; font-weight: bold">Незавершенные заказы</p>
        <div class="prof-order">
            @foreach ($ords as $ord)
                <div class="ords">
                    <div class="ord">
                        <p class="profil-p">Дата заказа: {{ \Carbon\Carbon::parse($ord->created_at)->format('d.m.Y') }}</p>
                        <p class="profil-p">Статус: {{ $ord->status }}</p>
                    </div>
                    <div class="items">
                        @foreach ($items as $item)
                            @if ($item->order_id == $ord->id)
                                <div class="item">
                                    <img src="/image/{{ $item->photo }}" alt="{{ $item->photo }}">
                                    <p class="profil-p2">Продукт: <br>{{ $item->prod }}</p>
                                    <p class="profil-p2" style="font-size: 20px">Цена: {{ $item->sum }}₽</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        </div>
        @endif

    </div>
    <div>

    </div>

</div>

@endsection
