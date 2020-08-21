<?php

namespace App\Controllers;


use App\Http\Request;
use App\Models\Task;
use Illuminate\Pagination\UrlWindow;

class HomePageController extends Controller
{
    public function index()
    {
        $tasks = Task::sort()->withPerPage(3);


        return view('pages.home', [
            'tasks'    => $tasks,
            'elements' => UrlWindow::make($tasks),
        ]);
    }

}