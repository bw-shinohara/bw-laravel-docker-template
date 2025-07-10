<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index()
    {
        // 追加
        $todo = new Todo();
        $todos = $todo->all();
        // dd($todos);

        return view('todo.index', ['todos' => $todos]); 
    }
    
}
