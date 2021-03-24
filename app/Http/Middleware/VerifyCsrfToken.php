<?php

// CSRF トークンのチェック処理を行います。実処理は親クラスが持っており、このファイルではチェックを行わない URL などを設定します。
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
