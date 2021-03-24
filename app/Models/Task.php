<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
/*
$this->attributes['status'] で状態カラムの値を取得している以外は、getStatusLabelAttribute メソッドの中身は普通の PHP です。STATUS 配列から状態値をキーに文字列表現を探して返しています。


*/

class Task extends Model
{

    // 中身は getStatusLabelAttribute メソッドとほとんど一緒ですね。label の代わりに class を返しています。
    const STATUS = [
        1 => ['label' => '未着手', 'class' => 'label-danger'],
        2 => ['label' => '着手中', 'class' => 'label-info'],
        3 => ['label' => '完了', 'class' => ''],
    ];

    // アクセサとは、モデルクラスが本来持つデータを加工した値を、さもモデルクラスのプロパティであるかのように参照できる Laravel の機能です。
    public function getStatusLabelAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }
}
