@extends('layout')

@section('content')

    <form action="{{ $task->id ? url('tasks/'.$task->id)  : url('tasks') }}" method="POST">
        @include('partials.csrf_field')

        @if($task->id)
            <input type="hidden" name="_method" value="PUT">
        @endif

        <div class="form-group">
            <label for="">Имя</label>
            <input type="text" name="username" class="form-control"
                   value="{{ $old->get('username') ?: $task->username }}"
                   aria-describedby="emailHelp">

            @if($errors->has('username'))
                <small class="form-text text-danger">{{ $errors->get('username')[0] }}</small>
            @endif

        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ $old->get('email') ?: $task->email }}"
                   aria-describedby="emailHelp">

            @if($errors->has('email'))
                <small class="form-text text-danger">{{ $errors->get('email')[0] }}</small>
            @endif


        </div>
        <div class="form-group">
            <label for="ee">Текст</label>
            <textarea id="ee" name="text" class="form-control">{{ $old->get('text') ?: $task->text }}</textarea>
            @if($errors->has('text'))
                <small id="emailHelp" class="form-text text-danger">{{ $errors->get('text')[0] }}</small>
            @endif
        </div>
        @if(session('authenticated'))
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="done_flag" id="exampleCheck1"
                       @if(($old->get('done') ?: $task->done))  checked="checked" @endif>
                <label class="form-check-label" for="exampleCheck1">Выполнено</label>
            </div>@endif
        <button type="submit" class="btn btn-outline-primary">Сохранить</button>
        <a href="{{ url('/') }}" class="btn btn-outline-danger">Отмена</a>
    </form>

@endsection