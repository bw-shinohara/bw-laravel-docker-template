# Laravel Lesson レビュー①

## Todo一覧機能

### Todoモデルのallメソッドで実行しているSQLは何か
SELECT * FROM todos;


### Todoモデルのallメソッドの返り値は何か
Illuminate\Database\Eloquent\Collectionクラスのインスタンス

### 配列の代わりにCollectionクラスを使用するメリットは
・Laravelが提供する便利なメソッド（filter, map, pluckなど）が使える。
・メソッドチェーンによる簡潔な記述が可能。
・再利用性・可読性の向上につながる。

### view関数の第1・第2引数の指定と何をしているか
・第1引数：表示するビューのパス（例：'todo.index'）
・第2引数：ビューに渡すデータの連想配列（例：['todos' => $todos]）
・機能：指定したBladeテンプレートをHTMLとして返す。

### index.blade.phpの$todos・$todoに代入されているものは何か
・$todos：コントローラで取得した Collection インスタンス（Todoモデルの一覧）
・$todo：$todos に格納された1つ1つの Todo モデルインスタンス


## Todo作成機能

### Requestクラスのallメソッドは何をしているか
フォームから送信された全データを連想配列で一括取得している。

### fillメソッドは何をしているか
引数に指定した連想配列をモデルのプロパティに一括代入する。

### $fillableは何のために設定しているか
一括代入による脆弱性対策で、代入可能なカラムを制限するため。

### saveメソッドで実行しているSQLは何か
・新規保存時：INSERT INTO todos (...) VALUES (...)
・更新時：UPDATE todos SET ... WHERE id = ...

### redirect()->route()は何をしているか
指定したルート名にリダイレクトします。



## その他

### テーブル構成をマイグレーションファイルで管理するメリット
・SQL文なしでDB構造を定義できる（PHPで記述）
・チーム開発で構成の同期が取りやすい
・バージョン管理できるため、状態の復元や履歴追跡が容易

### マイグレーションファイルのup()、down()は何のコマンドを実行した時に呼び出されるのか
・up()： php artisan migrate 
・down()： php artisan migrate:rollback

### Seederクラスの役割は何か
テストデータや初期データをDBに登録する。

### route関数の引数・返り値・使用するメリット
・引数：第1引数にルート名（例：'todo.index'）、第2引数にパラメータ（省略可）

・返り値：ルートに対応する URL文字列

・メリット：
　　URLのハードコードを防げる → 保守性UP
　　パラメータも安全に付与される
　　コントローラ・ビューで共通して使用可能


### @extends・@section・@yieldの関係性とbladeを分割するメリット
・@extends('layouts.app')：親テンプレートを継承

・@section('content') ... @endsection：子で内容を定義

・@yield('content')：親で子の挿入位置を指定

・Bladeを分割するメリット：
　　レイアウトの共通化（DRY）
　　保守性・可読性の向上

### @csrfは何のための記述か
CSRF対策のためのトークンが含まれたinputタグを生成する。

### {{ }}とは何の省略系か
{{ }} は <?php echo e( ); ?> の省略記法です。
自動的にHTMLエスケープがかかります（XSS対策済み）。