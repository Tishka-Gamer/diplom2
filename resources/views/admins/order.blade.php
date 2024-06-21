@extends('admins.layout')
@section('title')
Продукты
@endsection
@section('content')

<div>
    <div id="checkboxes-container">
        @foreach ($statuses as $status)
        <label for="f{{$status->id}}"> <input type="checkbox"  class="status-filter" name="filtr" value="{{$status->id}}" id="f{{$status->id}}"> {{$status->name}}</label>

        @endforeach

    </div>
    <table id="data-table" class="table  table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">адрес</th>
            <th scope="col">пользователь</th>
            <th scope="col">дата создания</th>
            <th scope="col">дата выдачи </th>
            <th scope="col">редактировать статус</th>
            <th scope="col">удалить</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <th scope="row">{{$order->id}}</th>
                <td>{{$order->adress}}</td>
                <td>{{$order->user}}</td>
                <td>{{\Carbon\Carbon::parse($order->created_at)->format('d.m.Y')}}</td>
                <td>{{\Carbon\Carbon::parse($order->updated_at)->format('d.m.Y')}}</td>
                <input type="text" name="id"  id="orderId" value="{{$order->id}}" hidden>
                <td>
                    @if ($order->status_id == 3)
                    Завершен
                    @else
                    <select name="statusSelect" class="statusSelect" data-order-id={{$order->id}}>
                        @foreach ($statuses as $status)
                            <option value="{{$status->id}}" {{$status->id == $order->status_id ? 'selected' : ''}}>{{$status->name}}</option>
                        @endforeach
                    </select>
                    @endif

                </td>
                <td><form action="{{Route('delord')}}"><button class="btn btn-primary " name="id" type="submit" value="{{$order->id}}">del</button></form></td>
              </tr>
            @endforeach
        </tbody>
      </table>
      <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
</div>

@endsection
@section('script')
<script src="/js/status.js"></script>

@endsection
