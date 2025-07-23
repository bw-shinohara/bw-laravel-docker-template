<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';// 紐づくテーブル名

    // 代入できる項目に制限をかける  fill()で代入許可するカラム
    // 意図しないカラムを更新されないようにする
    protected $fillable = [
        'content',
    ];
}


// 具体的な攻撃内容と結果　を言語化


// 前提。アプリケーションのDBにuser_idカラムがあったとする。

// 
// 勝手に攻撃者がブラウザ側からフォームタグのinputタグをいじり、都合のいいinputタグをつくる。例：name="user_id"
// 今アプリケーションにログインして投稿リクエストを送っている人のID を取得できるAuth::id()メソッド
// 本当は攻撃者がログインしているのに、正規のユーザーのuser_idを勝手に使う。
// Auth::id()メソッド　⇒　$todo->fill($inputs);の順だと、攻撃者のidに正規のユーザーのidを上書きできてしまう
// 正規のユーザーのidを指定できることでなりすましが可能


// user_idの例だと、
// 攻撃者のuser_idは本当は100なのに、
// create.blade.phpファイルのフォームタグのinputタグのname属性に「user_id＝4」を書いたら、
// 勝手に4に上書きして、
// user_idが4の人である田中さんが
// 「いまから会社を爆破しまーす♪」
// という投稿ができてしまう

