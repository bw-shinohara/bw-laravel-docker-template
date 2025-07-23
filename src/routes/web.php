<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/todo', 'TodoController@index');
// Route::get('/todo/create', 'TodoController@create'); 
Route::get('/todo/create', 'TodoController@create')->name('todo.create'); 
Route::post('/todo', 'TodoController@store')->name('todo.store');
// /todoにアクセスした際に、TodoControllerファイルのindexメソッドに処理を移譲
Route::get('/todo', 'TodoController@index')->name('todo.index'); // ルート名の定義を追記

// nameはメソッドですが、機能は「名前付きルート」
// ルートに**あだ名（ニックネーム）**をつけることで、
// URLが変わっても柔軟に対応できるようにするためのLaravelの機能

// 可読性と保守性を上げる

// 
// 直接URLを記述すると、
// ・可読性が低い
// ・URLに変更があった場合に関連する全ての記述を修正する必要があり保守性が低い




// Routeは ヘルパ関数ではなく「ファサード」クラス です。
// ファサード（Facade）とは？
// Laravelの機能を“簡潔に”呼び出すための仕組み。
// クラスの実体を隠して、静的メソッド風に見せてくれる
// 「RouteはLaravelのファサードです。
// Laravelのルーティング機能を簡潔に記述できるように作られていて、
// 他のフレームワークでは使えません。
// 実体はサービスコンテナで管理されていて、
// 静的メソッド風に呼び出せるのが特徴です」インスタンスです