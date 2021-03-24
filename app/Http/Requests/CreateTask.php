<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*
title のバリデーションルールはフォルダ作成のときと同様ですね。due_date のルールには date（日付を表す値であること）と after_or_equal（特定の日付と同じまたはそれ以降の日付であること）を使用しています。
after_or_equal の引数として today を指定することにより今日を含んだ未来日だけを許容します（タスクの期限日が過去だとおかしいですよね）。
*/

class CreateTask extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'due_date' => '期限日',
        ];
    }


    // また CreateTask では messages メソッドも実装しています。このメソッドは FormRequest クラス単位でエラーメッセージするために定義します。
    public function messages()
    {
        return [
            // due_date の after_or_equal ルールに違反した場合は、値に指定されたメッセージを出力するという意味です。
            // 一般的なルールについては validation.php に記述しますが、messages メソッドでは個別の FormRequest クラスの内部でのみ有効なメッセージを定義できます。
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
