<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    // 指定したカラムのみ値の代入を許可する。
    //create()メソッドによる登録はマスアサインメントになるので、モデルに$fillableを定義しておく。
    protected $fillable = [
        'caption',
        'detail',
        'datetime',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'file1',
        'file2',
        'file3',
        'file4',
        'file5',
        'maplink'
    ];


    public function InsertSchedule($request)
    {
        // リクエストデータを基に登録する
        return $this->create([
            'caption' => $request->caption,
            'detail'  => $request->detail,
            'datetime'  => $request->datetime,
            'image1' =>  $request->image1,
            'image2' =>  $request->image2,
            'image3' =>  $request->image3,
            'image4' =>  $request->image4,
            'image5' =>  $request->image5,
            'file1' =>  $request->file1,
            'file2' =>  $request->file2,
            'file3' =>  $request->file3,
            'file4' =>  $request->file4,
            'file5' =>  $request->file5,
            'maplink' =>  $request->maplink,        
        ]);
    }
}
