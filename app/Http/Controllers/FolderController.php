<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Http\Requests\CreateFolder;
use App\Http\Requests\CreateProgress;
use App\Models\Progress;

// フォルダーの新規作成コントローラー
class FolderController extends Controller
{
    // このルートはフォーム画面を返すだけなのでシンプルです。
    // フォルダ作成画面へ遷移させるメソッド
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // 一つ目のポイントはユーザーの入力値をコントローラーで受け取る方法です。
    // コントローラーメソッドの引数に Request クラスのインスタンスを受け入れる記述をします。
    // これによって、コントローラーメソッドが呼び出されるときに Laravel がリクエストの情報を Request クラスのインスタンス $request に詰めて引数として渡してくれます。
    // Request クラスのインスタンスにはリクエストヘッダや送信元IPなどいろいろな情報が含まれていますが、その中にフォームの入力値も入っています。
    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();

        // タイトルに入力値を代入する
        // リクエスト中の入力値は下記のようにプロパティとして取得することができます。
        $folder->title = $request->title;

        // インスタンスの状態をデータベースに書き込む
        /*
            データベースへの書き込みは以下の手順で実装します。
            モデルクラスのインスタンスを作成する。
            インスタンスのプロパティに値を代入する。
            save メソッドを呼び出す。
            これにより、モデルクラスが表すテーブルに対して INSERT が実行されます。感覚的に理解できるかもしれませんが、モデルクラスのプロパティに代入した値が各カラムに書き込まれます。
        */
        $folder->save();

        // 画面を作る必要はないので view メソッドは呼びません。代わりに redirect メソッドを呼び出します。
        // リダイレクト先を指定するために、redirect メソッドに続いて route メソッドを呼び出しています。
        // ルートでidが必要なため、該当のIDを引数にしてリダイレクトしている。

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
    public function createProgress(CreateProgress $request)
    {
        // フォルダモデルのインスタンスを作成する
        $progress = new Progress();

        // タイトルに入力値を代入する
        // リクエスト中の入力値は下記のようにプロパティとして取得することができます。
        $progress->comment = "";

        // インスタンスの状態をデータベースに書き込む
        /*
            データベースへの書き込みは以下の手順で実装します。
            モデルクラスのインスタンスを作成する。
            インスタンスのプロパティに値を代入する。
            save メソッドを呼び出す。
            これにより、モデルクラスが表すテーブルに対して INSERT が実行されます。感覚的に理解できるかもしれませんが、モデルクラスのプロパティに代入した値が各カラムに書き込まれます。
        */
        $progress->save();

        // 画面を作る必要はないので view メソッドは呼びません。代わりに redirect メソッドを呼び出します。
        // リダイレクト先を指定するために、redirect メソッドに続いて route メソッドを呼び出しています。
        // ルートでidが必要なため、該当のIDを引数にしてリダイレクトしている。
        return redirect()->route('tasks.index', [
            'id' => $progress->id,
        ]);
    }
}
