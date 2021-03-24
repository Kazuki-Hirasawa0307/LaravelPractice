<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //可変項目（DBのカラム）
    protected $fillable = [
        'title',
        'memo'
    ];
}
