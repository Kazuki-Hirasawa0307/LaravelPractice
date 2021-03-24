<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{

    // まずは authorize メソッドには true を返却させます。authorize メソッドはリクエストの内容に基づいた権限チェックのために使います。
    // 今回はこの機能は使用しないので true を返す（つまりリクエストを受け付ける）記述のみで OK です。
    public function authorize()
    {
        return true;
    }


    // さて重要なのが rule メソッドです。ここで、入力欄ごとにチェックするルールを定義します。rule メソッドが返却する配列がルールを表しています。
    // 配列のキーが入力欄です。HTML 側での input 要素の name 属性に対応します。キーに対する値の部分でルールを指定します。必須入力を意味する required を指定しています。
    // max:20 が入力上限20文字を意味します。複数のルールは | で区切ります。

    public function rules()
    {
        return [
            'title' => 'required|max:20',
        ];
    }

    // 入力欄の名称をカスタマイズするには、FormRequest クラスに attributes メソッドを追加します。CreateFolder.php に以下の attributes メソッドを追記してください。
    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
