@extends('layouts.layout')
@section('title')
Заказы
@endsection
@section('content')
@if ($orders != [])
<div>
    <div class="order-cont">
        @foreach ($orders as $order)
        <div class="order-cont2">
            <div class="order-row">
                <div>
                    <p class="profil-p">Статус: {{$order->status}}</p>
                </div>
                <div>
                    <p class="profil-p">Адрес: {{$order->adress}}</p>
                </div>
                <div>
                    <p style="padding: 0px 10px;" class="profil-p">Номер заказа: {{$order->number}}</p>
                </div>
                <div>
                    <p class="profil-p">Дата заказа: {{$order->created_at}}</p>
                </div>
                <div>
                    @if ($order->updated_at != '')
                    <p class="profil-p">Дата доставки: {{$order->updated_at}}</p>
                    @endif
                </div>
            </div>
            <div class="order-prods">
                @foreach ($products as $prod)
                @if ($prod->order_id == $order->id)
                <div class="order-prod">
                    <img src="/image/{{$prod->photo}}" alt="{{$prod->photo}}">
                    <p>Итоговая стоимость: {{$prod->sum}}</p>
                    <p >{{$prod->prod}}</p>
                    <p >Количество: {{$prod->count}}</p>
                    @foreach ($ingridients as $ing)
                    @if ($ing->order_id == $prod->id)
                    <p>Ингридиенты:</p>
                    <ul>
                        @foreach ($milks as $milk)
                        @if ($milk->order_id == $prod->id)
                            <li><p>{{$milk->milk}}</p></li>
                        @endif
                        @endforeach
                        @foreach ($ingridients as $ing)
                        @if ($ing->order_id == $prod->id)
                            <li><p>{{$ing->ingr}}</p></li>
                        @endif
                        @endforeach
                    </ul>
                    @endif
                    @endforeach

                </div>

                @endif

                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

@else
    <div>
        <h1>Заказов нет!</h1>
        <img src="/image/20688.svg" alt="basket">
        <h1>Вперед за покупками</h1>
        <a href="/menu">Перейти</a>
    </div>
@endif

@endsection

