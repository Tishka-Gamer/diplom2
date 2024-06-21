@extends('layouts.layout')
@section('title')
Меню
@endsection
@section('content')
<div class="category">
    <ul class="cat-ul">
        <li class="cat-li"><a href="#current">Сезонное</a></li>
    @foreach ($categories as $category)
        <li class="cat-li"><a href="#{{$category['name']}}">{{$category['name']}}</a></li>
    @endforeach
    </ul>
</div>
<div>
    <form action="{{Route('menu')}}" class="sort">
        <label for="form-select">Сортировать по</label>
        <select class="form-select" name="fll" aria-label="Сортировать по">
            <option value="" {{$item == 0 ? 'selected' : ''}}>Сначала новое</option>
            <option value="ASC" {{$item == 1 ? 'selected' : ''}}>Сначала дешевле</option>
            <option value="DESC" {{$item == 2 ? 'selected' : ''}}>Сначала дороже</option>
        </select>
        <button class="btn cat-btn" name="filtr" type="submit">Показать</button>
    </form>
</div>
<div>
    <button id="scrollToTopBtn">&#9650;</button>
    <br>
    <div><h1 style="text-align: center;" id="current">Сезонное</h1></div>
    <br>
    <div class="products container">
        <main class="products-grid">
        @foreach ($currents as $current)
        <article>
            <a href="/show/?id={{$current->pr_id}}"><img src="/image/{{$current->photo}}" alt="">
            <div class="text men-t">
                <a href="/show/?id={{$current->pr_id}}" style=" color: rgb(84, 53, 30);
                            text-decoration: none;"><h3>{{$current->name}}</h3></a>
                <p style="height: 100px">{{$current->description}}</p>
                <form action="{{Route('show')}}">
                    <button class="btn btn-primary btn-block cat-btn" name="id" value="{{$current->pr_id}}">Подробнее</button>
                </form>
            </div>
        </article>
        @endforeach
    </main>
    </div>
    @foreach ($categories as $category)
    <br>
    <div><h1 style="text-align: center;" id="{{$category['name']}}">{{$category['name']}}</h1></div>
    <br>
    <div class="products container">
        <main class="products-grid">
        @foreach ($products as $product)
        @if ($product->category_id ==  $category['id'])
              <article>
                <a href="/show/?id={{$product->id}}"><img src="/image/{{$product->photo}}" alt="">
                <div class="text men-t">
                    <a href="/show/?id={{$product->id}}" style=" color: rgb(84, 53, 30);
                        text-decoration: none;"><h3>{{$product->name}}</h3></a>
                  <p style="height: 100px;">{{$product->description}}</p>
                  <form style="ggg" action="{{Route('show')}}">
                    <button class="btn btn-primary btn-block cat-btn" name="id" value="{{$product->id}}">Подробнее</button>
                  </form>

                </div>
              </article>
        @endif
        @endforeach
    </main>
    </div>
    @endforeach

</div>

@endsection
@section('script')
<script src="/js/catalogs.js"></script>
@endsection
