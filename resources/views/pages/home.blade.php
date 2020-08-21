@extends('layout')

@section('content')

    <div class="row d-flex justify-content-end mb-3">
        <a href="{{ url('tasks/create') }}" class="btn btn-success">Добавить задачу</a>
    </div>
    <div class="row">
        @if(!$tasks->isEmpty())
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">Username {!! sortLink('username') !!}</th>
                    <th scope="col">Email {!! sortLink('email') !!}</th>
                    <th scope="col">Text</th>
                    <th scope="col">Status {!! sortLink('email') !!}</th>
                    @if(session('authenticated'))
                        <th></th> @endif
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->username }}</td>
                        <td>{{ $task->email }}</td>
                        <td>{{ str_limit($task->text,50)}}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <div>{{ $task->status }}</div>
                                <div>{{ $task->editedByAdmin }}</div>
                            </div>
                        </td>
                        @if(session('authenticated'))
                            <th>
                                <a href="{{ url('tasks/'.$task->id.'/edit') }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-pencil"></i></a>
                            </th>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h3>Нет данных</h3>
        @endif
        @include('pagination',['paginator'=>$tasks,'elements'=>$elements])
    </div>

@endsection