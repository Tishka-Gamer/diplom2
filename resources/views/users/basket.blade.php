@extends('layouts.layout')
@section('title')
Корзина
@endsection
@section('content')
@if ($products != [])
<div id="cart-items" class="basket">
    <div class="bask-prod">
        @foreach ($products as $product)
        <div class="product-item" data-id="{{$product->products_id}}">
            {{-- <input type="checkbox" name="prod" value="{{$product->products_id}}"> --}}
            <img width="150px" height="150px" src="/image/{{$product->photo}}" alt="">
            <div class="text">
                <h3>{{$product->name}}</h3>
                <p class="bask-desk">{{$product->description}}</p>
                <p style="font-size: 30px;" > <span style="font-size: 35; color: rgb(79, 47, 19); font-weight: bold;" class="price">{{$product->price}}₽</span></p>
            </div>
            <div>
                @if ($one != [])
                @foreach ($one as $i)
                    @if ($i->product_id == $product->id)
                    <p style="font-size: 20px;">Добавки:</p>
                    <ul>
                        @foreach ($milk as $m)
                        @if ($m->product_id == $product->id)
                        <li>{{$milk[0]->name}}</li>
                        @endif
                        @endforeach
                        @foreach ($one as $i)
                        <li>{{$i->ingr}}</li>
                        @endforeach

                    </ul>
                    @endif
                @endforeach
                @else

                @endif

            </div>
            <div class="right">
                <div class="right-c">
                    <button class="del desc closed" data-id="{{$product->products_id}}">x</button>
                    <div class="counter">
                        <button class="plus desc" data-id="{{$product->products_id}}"style="font-weight: bold;">+</button>
                        <input type="text" class="count desc" style="width: 40px" value="{{$product->count}}" name="count">
                        <button class="minus desc" data-id="{{$product->products_id}}" style="font-weight: bold;">—</button>
                    </div>
                </div>


            </div>
        </div>
        <br>
        @endforeach
    </div>
    <div>
        <form method="post" action="{{Route('order')}}" class="basket-font">
            @csrf
            <div class="form-check">
                <input class="form-check-input" name="sam" class="qwe" type="checkbox" value="1" id="flexCheckChecked" checked>
                <label class="form-check-label" style="font-size: 20px; text-align: center" for="flexCheckChecked">
                  Самовывоз
                </label>
              </div>
            <div class="haid" id="haid" style="display: none;">
                <label for="address"  style="font-size: 20px; text-align: center">Введите адрес</label>
                <input id="address"  style="width: 270px; background-color: rgba(255, 255, 255, 0);" name="address" type="text">
            </div>
            <div>
                <p style="font-size: 30px; text-align: center" id="total-cost">Общая стоимость: <span style="font-size: 35; color: rgb(79, 47, 19); font-weight: bold;">{{$sum[0]->sum}}₽</span></p>
            </div>
            <div>
                <p>Перед заказом убедитесь что почта в профиле актуальная и не содержит ошибок. В ином случае вы можете ее изменить.</p>
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary bask-btn" data-toggle="modal" data-target="#exampleModal">
                Заказать
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Оплата</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <h5>Дальнейшая инструкция по оплате будет отправлена вам на почту.</h5>
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Заказать</button>
                    </div>
                </div>
                </div>
            </div>
            {{-- <div>
                <button class="bask-btn" name="ord"></button>
            </div> --}}

        </form>
    </div>
</div>

@else
    <div class="basketnull">
        <h1>Корзина пуста!</h1>
        <img src="/image/20688.svg" alt="basket">
        <h1>Вперед за покупками</h1>
        <a href="/menu">Перейти</a>
    </div>
@endif
<input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
@endsection
@section('script')
<script src="/js/basket.js"></script>

@endsection

