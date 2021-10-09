<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Events\TaskCreated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('tasks', function () {
    return Task::latest()->pluck('body');
});


Route::post('tasks', function () {
    $task = Task::forceCreate(request(['body']));
    // (new TaskCreated($task))->dontBroadcastToCurrentUser();
    TaskCreated::dispatch($task);
});
