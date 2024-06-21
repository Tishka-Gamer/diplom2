@extends('layouts.layout')
@section('title')
Карточка товара
@endsection
@section('content')
<div>

</div>

<div>
    <a href="/menu"   style=" color: rgb(84, 53, 30); margin-left: 10px; margin-top: 10px; padding: 15px; font-size: 25px;">&#8592; Назад</a>
    <form action="{{Route('addbask')}}" class="show-form">
        <div>
            <img src="/image/{{$product->photo}}" alt="" class="show-img">
        </div>
        <div>
            <div class="show-info">
                <h3 class="show-price" style="margin-top: -50px">{{$product->name}}</h3>
                <p>{{$product->description}}</p>
                <p>Состав: {{$product->structure}}</p>
            </div>
            @if ($product->category_id == 1 && $product->id != 2)
            <div>
                <label for="milk" class="form-label">Выберите молоко</label>
                <select name="milk" class="form-control" id="milk">
                    @foreach ($milks as $milk)
                        <option value="{{$milk->id}}" {{$milk->id == 1 ? 'selected' : ''}}>{{$milk->name}}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Белки / Жиры / Углеводы</th>
                            <th scope="col">Ккал / кДЖ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$product->bgu}}</td>
                            <td>{{$product->callories}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                @if ($ingridients != [])
                <h5>Добавить?</h5>
                @foreach ($ingridients as $ing)
                <div class="">
                    <input type="checkbox" name="ing[]" value="{{$ing->ing}}" id="ing">
                    <label for="ing" class="show-p">{{$ing->name}}</label>
                </div>
                @endforeach
                @endif
            </div>
            <div class="show-btns">
                <p name="price" class="show-price">Цена: {{$product->price}}₽</p>
                <input type="hidden" name="price" value="{{$product->price}}">
                @if (session('id') != null)
                <button class="btn btn-primary btn-block show-btn" style="width: 200px" name="id" value="{{$product->id}}">Добавить в корзину</button>
                @else
                <a href="/auth"  style="width: 200px" class="btn btn-primary btn-block show-btn">Добавить в корзину</a>
                @endif

            </div>

        </div>
    </form>
    <div class="ost-rev">
        @if ($uss == 1)
        <form action="{{Route('review')}}" class="show-form-two">
           <p class="show-p">Оставьте отзыв! Это поможет сделать качество товара лучше.</p>
            <textarea name="review" pattern="^[^<>\[\]\\\/]*$" class="ar-rew" id="review" cols="60" rows="2"></textarea>
            <br>
            <button type="submit" name="btn" class="btn" value="{{$product->id}}">Опубликовать</button>
        </form>
        @endif
    </div>

    <br>
    <div>
        @if ($reviews != [])
        <h1 style="text-align: center">Отзывы:</h1>
        @foreach ($reviews as $review)
        <div class="review-show">
            <div class="rev-row">
                <div>
                    <p class="show-p">{{$review->user}}</p>
                    <p class="show-p">{{\Carbon\Carbon::parse($review->updated_at)->format('d.m.Y')}}</p>
                </div>

                {{-- <form action="" method="POST">@csrf <button name="red" value="{{$review->id}}">Ред.</button></form>
                <button class="btn btn-primary" data-toggle="modal" data-target="#editReviewModal">Ред.</button> --}}
                <div>
                     @if ($review->user_id == session('id'))
                <button class="btn btn-primary edit-review-btn show-btn"
                data-toggle="modal"
                data-target="#editReviewModal"
                data-review-id="{{$review->id}}"
                data-review-content="{{$review->text}}">
                Ред.
                </button>
                <form action="{{Route('delrev')}}"> <input type="text" name="btn" class="btn" value="{{$product->id}}" hidden></input><button name="del" class="show-btn" value="{{$review->id}}">Удалить</button></form>
                @else
                <form action="{{Route('report')}}"><input type="hidden" name="prod" value="{{$product->id}}"><button type="submit" name="id" class="btn" value="{{$review->id}}">Пожаловаться</button></form>
                @endif
                </div>


            </div>
            <div>
                <button data-review-id="{{$review->id}}" hidden></button>
                <p class="show-p" data-review-content="{{$review->text}}" id="reviewContent-{{ $review->id }}">{{$review->text}}</p>
            </div>
        </div>
        @endforeach
        @else
        <h1 style="text-align: center">Здесь пока нет отзывов :(</h1>
        @endif
    </div>
    <div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog" aria-labelledby="editReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editReviewModalLabel">Редактировать отзыв</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Форма для редактирования отзыва -->
                    <form id="editReviewForm" method="POST">
                        <!-- Поля для редактирования отзыва -->
                        <textarea id="editedReviewContent" class="form-control"></textarea>
                        <!-- Поле для передачи ID отзыва -->
                        <input type="hidden" id="reviewId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="saveReviewChanges">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
</div>

@endsection
@section('script')
<script src="/js/review.js"></script>

@endsection

