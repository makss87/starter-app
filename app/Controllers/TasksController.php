<?php

namespace App\Controllers;


use App\Exceptions\AuthorizationException;
use App\Http\Request;
use App\Models\Task;


class TasksController extends Controller
{
    public function create()
    {
        return view('tasks.create_edit', [
            'task' => new Task(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        Task::create($request->all());

        $this->redirect('/');
    }

    public function edit($parameterValue)
    {
        $this->authorize();

        return view('tasks.create_edit', [
            'task' => Task::find($parameterValue),
        ]);
    }

    public function update($parameterValue, Request $request)
    {

        $this->authorize();

        $request->validate($this->rules());

        $request->request->set('done', $request->has('done_flag'));

        $task = Task::find($parameterValue);

        $task->update($request->all());

        $this->redirect('/');
    }

    public function rules()
    {
        return ['email' => 'required|email:rfc', 'username' => 'required|min:2|max:255'];
    }
}