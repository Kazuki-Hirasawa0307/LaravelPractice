<?php

// クッキーの暗号化を行います。実処理は親クラスが持っており、このファイルでは暗号化を行わないクッキーを設定します。
namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
