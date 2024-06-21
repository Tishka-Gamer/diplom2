@extends('layouts.layout')
@section('title')
Мои отзывы
@endsection
@section('content')
<div>
    <div class="review-cont">
        <h1 style="text-align: center;">Ваши отзывы</h1>
        @foreach ($reviews as $rev)
        <div class="review-cont2">
            <div>
                <div class="review-rev">
                    <div>
                        <p class="profil-p">{{$rev->created_at}}</p>
                    </div>
                    <div>
                         <form action="/show"><button name="id" class="review-prod" value="{{$rev->product_id}}">{{$rev->prod}}</button></form>
                    <button class="btn btn-primary edit-review-btn show-btn"
                    data-toggle="modal"
                    data-target="#editReviewModal"
                    data-review-id="{{$rev->id}}"
                    data-review-content="{{$rev->text}}">
                    Ред.
                    </button>
                    <form action="{{Route('delrev')}}"> <input type="text" name="btn" class="btn" value="{{$rev->product_id}}" hidden></input><button name="del" class="show-btn" value="{{$rev->id}}">Удалить</button></form>
                    </div>

                </div>
            </div>
            <div>
                <p class="profil-p" data-review-content="{{$rev->text}}" id="reviewContent-{{ $rev->id }}">{{$rev->text}}</p>
            </div>
        </div>
        <br>
        <br>
        @endforeach
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
                        <textarea id="editedReviewContent" pattern="^[^<>\[\]\\\/]*$" class="form-control"></textarea>
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
    <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
</div>


@endsection
@section('script')
<script src="/js/review.js"></script>

@endsection
