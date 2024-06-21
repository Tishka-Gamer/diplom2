@extends('admins.layout')
@section('title')
Статус
@endsection
@section('content')
<div>
    <form action="{{Route('addstatus')}}" method="POST">
        @csrf
        <label for="cat">Введите название статуса</label>
        <input type="text" name="name" id="cat">
        <button type="submit">Создать</button>
    </form>
</div>
<div>
    <table class="table  table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">Редактировать</th>
            <th scope="col">Удалить</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
            <tr>
                <th scope="row">{{$status->id}}</th>
                <td class="profil-p" data-review-content="{{$status->name}}" id="reviewContent-{{ $status->id }}">{{$status->name}}</td>
                <td><button class="btn btn-primary edit-review-btn show-btn"
                    data-toggle="modal"
                    data-target="#editReviewModal"
                    data-review-id="{{$status->id}}"
                    data-review-content="{{$status->name}}">
                    Ред.
                    </button></td>
                    <td><form action="{{Route('delstatus')}}" method="POST">@csrf
                        @method('DELETE')<button type="submit"  class="btn btn-primary " name="id" value="{{$status->id}}">del.</button></form></td>
              </tr>
            @endforeach

        </tbody>
      </table>
      <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
        <div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog" aria-labelledby="editReviewModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReviewModalLabel">Редактировать статус</h5>
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

@endsection
@section('script')
<script src="/js/redstatus.js"></script>

@endsection
