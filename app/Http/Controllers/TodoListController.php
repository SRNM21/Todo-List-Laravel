<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\View\View;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        $todos_data = DB::table('todos')->where('status', '<>', 'archive')->orderByRaw('date_created ASC')->get();

        return view('home', [
            'todos' => $todos_data,
        ]);
    }

    public function store(Request $request)
    {
        if ($request['func'] == 'ADD_TASK')
        {
            $data = [
                'todo_id' => TodoListController::generateID(),
                'todo' => $request['new_todo'],
                'status' => 'pending',
                'date_created' => Date::now()
            ];
    
            DB::table('todos')->insert($data);
    
            return view('components.todocard', $data);
        }
        else if ($request['func'] == 'TOGGLE_TASK')
        {
            DB::table('todos')->where(['todo_id' => $request['id']])->update(['status' => $request['status'] == 'done' ? 'pending' : 'done']);

            return response()->json(['msg' => $request['id']]);
        }
        else if ($request['func'] == 'DELETE_TASK')
        {
            DB::table('todos')->where(['todo_id' => $request['id']])->delete();
            
            return response()->json(['msg' => $request['id']]);
        }
    }

    private function generateID()
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    
        $id = 'TODO-';
    
        for ($i = 0; $i < 5; $i++) 
        {
            $id .= $chars[rand(0, strlen($chars) - 1)];
        }
    
        return $id;
    }
}
