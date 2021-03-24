<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    // tasks メソッドの中で hasMany メソッドを呼び出していますが、
    // これにより Laravel はフォルダテーブルとタスクテーブルの関連性（リレーション）を「たどって」、フォルダクラスのインスタンスから紐づくタスククラスのリストを取得します。
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    public function progresses()
    {
        return $this->hasMany('App\Models\Progress');
    }
}

/*
 例えばこのモデルクラスがどのテーブルに対応しているかはクラス名から自動的に推定されます。
 つまりモデルクラスのクラス名の複数形のテーブルが対応していると解釈されるのです。今回であれば folders テーブルですね。
 もちろんこのデフォルトの推定に当てはまらない場合は追加で設定を書けばいいのですが、今回はこの仕組みに合わせてあるのでその必要はありません。
 */
