<?php

use App\Http\Controllers\AddTodo;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoListController::class, 'index']);
Route::post('/', [TodoListController::class, 'store']);
Route::post('/add-todo', AddTodo::class);

