@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-4">
                <nav class="panel panel-default">
                    <div class="panel-heading">案件一覧</div>
                    <div class="panel-body">
                        <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
                            案件を追加する
                        </a>
                    </div>
                    <div class="list-group">
                        @foreach ($folders as $folder)
                            <a href="{{ route('tasks.index', ['id' => $folder->id]) }}"
                                class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">
                                {{ $folder->title }}
                            </a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="column col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">進捗</div>
                    <table class="table">
                        @foreach ($progress as $progress)
                            <tr>
                                <th style="width: 100%">概要</th>
                            </tr>
                            <tr>
                                <td style="width: 100%">{{ $progress->discription }}</td>
                                {{-- <td><a
                                            href="{{ route('progress.editDiscription', ['id' => $progress->folder_id, 'progress_id' => $progress->id]) }}">
                                            編集
                                        </a></td> --}}
                            </tr>
                    </table>
                    <table class="table">

                        <th>使用言語</th>
                        <th>取引先</th>
                        <th>メンバー</th>
                        <th>状態</th>
                        </tr>
                        <tr>
                            <td>{{ $progress->skill }}</td>
                            <td>{{ $progress->customer }}</td>
                            <td>{{ $progress->assignees }}</td>
                            <td>{{ $progress->status }}</td>
                            <td><a
                                    href="{{ route('progress.edit', ['id' => $progress->folder_id, 'progress_id' => $progress->id]) }}">編集</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="column col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">タスク</div>
                    <div class="panel-body">
                        <div class="text-right">
                            <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}"
                                class="btn btn-default btn-block">
                                タスクを追加する
                            </a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>タイトル</th>
                                <th>状態</th>
                                <th>期限</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>
                                        <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                                    </td>
                                    <td>{{ $task->formatted_due_date }}</td>
                                    <td><a
                                            href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">
                                            編集
                                        </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- キーと値が同じなのでややこしいですが、あくまでテンプレート側ではキー名が変数名になることを覚えておいてください。
変数の値の展開は、{{ $data }} のように波括弧二つで実現します。ここでは二箇所で使われていますね。
まずはタイトルの表示 {{ $folder->title }} です。$folders にすべてのフォルダのデータが入っているので、
foreach でループした一つのアイテムである $folder はフォルダテーブルの一行に相当すると考えられます。カラムの値は ->title と、プロパティのように参照することができます。

もう一つはアンカーリンクの href 属性です。
route('tasks.index', ['id' => $folder->id])
Laravel が提供している route 関数の結果を href の値として展開しています。
route 関数はルーティングの設定から URL を作り出す関数です。
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
route 関数の第一引数はルート名です。上記の通り、ルーティングの際に get メソッドに続けて呼び出した name メソッドの引数がそのルートの名前です。
route 関数の第二引数として渡している配列は、ルート URL のうち変数になっている部分（ここでは {id}）に実際の値を埋める役割です。 --}}
