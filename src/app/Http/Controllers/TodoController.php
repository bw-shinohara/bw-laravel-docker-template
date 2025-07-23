<?php
// Laravelが用意している親クラス　　　なぜ必要かは、①クラスの場所を正しく認識させるため　②ルーティングや依存解決で、Laravelが正しくクラスを見つけられるようにするため
// なくてもメソッドの引数にフルパスで書けばできる
namespace App\Http\Controllers;

use Illuminate\Http\Request;// ← Requestクラスの読み込み　　　　完全修飾クラス名（\App\Todo）で書けば、USEがなくても使える！　　でもUSE使うほうが短く書けて可読性・保守性が上がるから
use App\Todo;// ← Todoクラスの読み込み　　完全修飾クラス名（\App\Todo）で書けば、USEがなくても使える！　でもUSE使うほうが短く書けて可読性・保守性が上がるから

class TodoController extends Controller
{
    public function index()
    {
        // Todoクラスのインスタンス化。TodoModelをTodoControllerで使えるようにするため
        $todo = new Todo();
        // todosテーブルのレコードを全件取得
        $todos = $todo->all(); // 全件取得（Eloquentのallメソッド）
        // dd($todos);
        // ↑　
        // Illuminate\Database\Eloquent\Collection {#273 ▶}が出てくる


        // todo.index一覧ページでレコードを全件viewへ渡す
        return view('todo.index', ['todos' => $todos]); 
                // 絶対パス（最初のルートからのフルパス）と相対パス（今いる場所からを起点）　
                // 第1引数は何に対して相対パス？resources/views/から対象の*.blade.phpまでの相対パスを.区切りで指定」します。

    }

    public function create()
    {
        // TODO: 第1引数を指定
        return view('todo.create'); 
    }
    
    // メソッドインジェクション
    // メソッドの引数の左側にクラス名を書くことで、インスタンス化が自動で行われる
    public function store(Request $request)
    {
        // フォームから送信された値を個別で取得
        // $content  = $request->input('content');　　contentはname属性
        
        // フォームから送信された値を個別ではなく全入力値を一括で取得
        $inputs = $request->all(); 
        // dd($inputs); 
        // ↑
        // CSRF対策のtokenと、内容が連想配列で出てくる　配列型


        // 1. todosテーブルの1レコードを表すTodoクラスをインスタンス化
        $todo = new Todo();
        // dd($todo);
        // attributesが空のまま


        // 2. Todoインスタンスのカラム名のプロパティに保存したい値を代入
        // $todo->content = $content;
        $todo->fill($inputs); // Todoインスタンスの各プロパティに一括で代入　　
        // todoインスタンスのどこ（Todoインスタンスの各プロパティ）に何（リクエストの値＝保存前のtodoの内容）を代入。
        
        //　差分は？？？
        // ↓
        // dd($todo);
        // attributesにtodoのcontentが入っている


        

        // 3. Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
        $todo->save();

        return redirect()->route('todo.index');
        // todoの部分をtestに変えたら　なにをどう書くと同じ挙動？
        // Route::get('/todo', 'TodoController@index')->name('test.index'); 

        // 引数に何がはいっている？ルート名（todo.index　＝　/todo', 'TodoController@index）



        // Collectionが便利なのは、何に対して？ どういう理由で便利なの？

        // どんな時に便利なのか？
        // 例：条件をしぼって表示させたいとき
        // ToDo の中から、”今日作成された”ものだけ表示したい


        // 配列だとこう記述する
    //     $todos = Todo::all()->toArray(); // Eloquentじゃなくして配列にする
    //     $today = [];
    //     foreach ($todos as $todo) {
    //     if (date('Y-m-d', strtotime($todo['created_at'])) === date('Y-m-d')) {
    //     $today[] = $todo;
    // }
    //    }  
    // strtotime() や date() を毎回書く
    // $today という配列を自分で作らなきゃいけない
    // 条件が複雑になるとどんどん読みにくくなる


        // collectionだとこう記述する
        // $todos = Todo::all();
        // $today = $todos->filter(function ($todo) {
        // return $todo->created_at->isToday();
        // });
        // $todo はモデルだから、created_at が Carbon インスタンス（日時処理に強い）
        // isToday() はそのまま「今日？」と聞ける便利メソッド
        // チェーンでどんどん繋げられる





// allメソッド　　なぜ　同じallメソッドなのに型が一貫していない？
// 「同じ名前でも、クラス（＝文脈）が違えば、意味も振る舞いも変えてよい」
// ＝**オブジェクト指向のポリモーフィズム（多態性）**の考え方

// 共通メソッド「all」
// モデルクラスならDBからレコードぜんぶ
// リクエストクラスのインスタンスならそのリクエストしたものぜんぶ

    }
}
