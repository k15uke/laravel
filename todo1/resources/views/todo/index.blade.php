@extends('layouts.todo')

@section('title', 'TODOリスト')

@section('style')
    <style>
        .complete {
            text-decoration: double line-through;
        }

    </style>
@endsection

@section('content')
    <form method="POST" action="./">
        @csrf
        <div class="form-row">
            <div class="col-md-3">
                <div class="form-group">
                    <input type="date" class="form-control" id="expiration_date" name="expiration_date"
                        area-describedby="expirationdateHelp"
                        value="{{ $errors->has('expiration_date') ? old('expiration_date') : $today }}">
                    @if ($errors->has('expiration_date'))
                        <div class="alert alert-danger py-0 px-1">
                            <small>{{ $errors->first('expiration_daate') }}</small>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" class="form-control" id="todo_item" name="todo_item" area-describedby="todoItemHelp"
                        value="{{ old('todo_item') }}">
                    @if ($errors->has('todo_item'))
                        <div class="alert alert-danger py-0 px-1">
                            <small>{{ $errors->first('todo_item') }}</small>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-1 align-bottom">
                <input type="submit" value="登録" class="btn btn-primary">
            </div>
        </div>
    </form>

    <div class="table-responsive mt-3">
        <table class="table">
            <tr>
                <th>期限日</th>
                <th>TODO項目</th>
                <th></th>
            </tr>
            @foreach($items as $item)
                <tr class="
                @if($item->is_completed == 1)
                    {{'complete'}}
                @elseif($item->expiration_date < $today)
                    {{'text-danger'}}
                @endif
                ">
                    <td>{{$item->expiration_date}}</td>
                    <td>{{$item->todo_item}}</td>
                    <td>
                        <form action="/update" method="GET">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="submit" value="更新" class="btn btn-outline-primary btn-sm">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

            