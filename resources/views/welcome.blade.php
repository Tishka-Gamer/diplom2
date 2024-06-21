@extends('layouts.layout')
@section('title')
Главная
@endsection
@section('content')
<div>
    <div class="font-img">
        <div class="font-text">
            <h1>Начни свое утро с чашечки кофе.</h1>
            <br>
            <h2>А также не забудь про завтрак.</h2>
            <a href="/menu" class="index-p amenu">Меню</a>
        </div>
    </div>
    <br>
    @foreach ($indexes as $index)
    @if ($index->block == 2 || $index->block == 4)
    <h1 class="index-h1">{{$index->h1}}</h1>
    <div class="index-grid">
        <div>
            <p class="index-p grid-p">{{$index->p}}</p>
        </div>
        <div>
            <img class="index-img" src="/image/{{$index->img}}" alt="">
        </div>
    </div>
    @else
    <h1 class="index-h1">{{$index->h1}}</h1>
    <div class="index-grid">
        <div>
            <img class="index-img" src="/image/{{$index->img}}" alt="">
        </div>
        <div>
            <p class="index-p grid-p">{{$index->p}}</p>
        </div>
    </div>
    @endif

    @endforeach
</div>
@endsection

