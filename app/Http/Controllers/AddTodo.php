<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class AddTodo extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = [
            'todo_id' => AddTodo::generateID(),
            'todo' => $request['new_todo'],
            'status' => 'pending',
            'date_created' => Date::now()
        ];

        DB::table('todos')->insert($data);

        return view('components.todocard', $data);
    }

    function  generateID()
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
