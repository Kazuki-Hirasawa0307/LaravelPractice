<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Progress;

// タスクの新規作成コントローラー

// Folder モデルの all クラスメソッドですべてのフォルダデータをデータベースから取得しています。
// Laravel の ORM は強力なので、SQL をまったく書かずにデータを取得できています。
class TaskController extends Controller
{
    public function index(int $id)
    {
        //select * from `folders`→フォルダの一覧を取得している。
        $folders = Folder::all();

        // 選ばれたフォルダを取得する
        // まず find メソッドは、プライマリキーのカラムを条件として一行分のデータを取得してきます。
        // select * from `folders` where `folders`.`id` = {id}
        // $users = DB::table('users')->get(); 全レコード出力
        // データベーステーブルから１レコードのみ取得する必要がある場合は、firstメソッドを使います。このメソッドはstdClassオブジェクトを返します。
        // $user = DB::table('users')->where('name', 'John')->first();
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        // where メソッドはデータの取得条件を表し、SQL の WHERE 句にあたります。第一引数がカラム名で第二引数が比較する値です。ただ厳密にいうと、上記の記述は以下の記述の省略形です。
        // select * from `tasks` where `tasks`.`folder_id` = 1 and `tasks`.`folder_id` is not null
        $tasks = $current_folder->tasks()->get(); // ★
        $progress = $current_folder->progresses()->get(); // ★
        // var_dump($tasks);

        // ここまでではまだ SQL 作っている段階なので値は取れません。get メソッドを忘れて「値が取れないぞ？？」となりがちなので気をつけましょう。



        // 次に view 関数でテンプレートに取得したデータを渡した結果を返却しています。view 関数の第一引数がテンプレートファイル名（後ほど作成します）で第二引数がテンプレートに渡すデータです。第二引数には配列を渡しますが、キーがテンプレート側で参照する際の変数名となります。
        // このように view 関数の結果をコントローラーメソッドから返却すると、テンプレートをレンダリングした結果の HTML がフレームワークによってブラウザにレスポンスされます。
        return view('tasks/index', [
            'folders' => $folders,
            // ただ id では分かりにくいので current_folder_id という名前で参照するように記述しました。
            'current_folder_id' => $id,
            'tasks' => $tasks,
            'progress' => $progress
        ]);
    }

    // テンプレートで form 要素の action 属性としてタスク作成 URL（/folders/{id}/tasks/create）を作るためにフォルダの ID が必要なので、
    // コントローラーメソッドの引数で受け取って view 関数でテンプレートに渡しています。
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $current_folder->tasks()->save($task);
        // 上の記述により、$current_folder に紐づくタスクを作成しています。

        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }
    public function showEditForm(int $id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        // 1
        $task = Task::find($task_id);

        // 2
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }
}
