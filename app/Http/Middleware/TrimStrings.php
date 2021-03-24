<?php

// 入力値から余計な空白を除く処理を行います。実処理は親クラスが持っており、このファイルでは空白除去を行わない入力値の name を設定します。
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];
}
