<?php

use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

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

// デフォルトではウェルカムページへ遷移する
Route::get('/', function () {
    return view('welcome');
});

//get で /folders/{id}/tasks にリクエストが来たら TaskController コントローラーの index メソッドを呼びだす、という記述です。
// また、最後にこのルートに名前をつけています。アプリケーションの中で URL を参照する際にはこの名前を使います。

// ポイントは URL 中の {id} でしょう。タスク一覧ページはフォルダごとのタスクを表示するので、/folders/123/tasks や /folders/999/tasks など、どのフォルダのタスクを表示したいかによって URL が変わります。その変わる部分を波括弧の箇所で表現します。波括弧の間の名前（今回は「id」）はどんな値でも構いません。
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');

Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create', 'FolderController@create');

Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('/folders/{id}/tasks/create', 'TaskController@create');


Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');

Route::get('/folders/{id}/progress/{progress_id}/editDiscription', 'ProgressController@showEditDiscriptionForm')->name('progress.editDiscription');
Route::post('/folders/{id}/progress/{progress_id}/editDiscription', 'ProgressController@editDiscription');

Route::get('/folders/{id}/progress/{progress_id}/edit', 'ProgressController@showEditForm')->name('progress.edit');
Route::post('/folders/{id}/progress/{progress_id}/edit', 'ProgressController@edit');
