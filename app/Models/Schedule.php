<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // 指定したカラムのみ値の代入を許可する。
    // protected $fillable = [
    //     'caption',
    //     'detail',
    // ];
}
