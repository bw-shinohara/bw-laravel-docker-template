@extends('layouts.base') <!-- 追記 -->
@section('content') <!-- 追記 -->
<div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">ToDo作成</div>
              <div class="card-body">
                <form method="post" action="{{ route('todo.store') }}">
                  <!-- testに変えたら Route::post('/todo', 'TodoController@store')->name('test.store');で同じ挙動

                   　ルート関数の引数（ルート名　　/todo', 'TodoController@store）、実行タイミング（HTML読み込み時）　返り値（ルートに対応する URL文字列
） -->
                  @csrf <!--@は何を省略する？    csrf_field　! -->
                  <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">ToDo入力</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="content" value="">
                    </div>
                  </div>
                  <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">作成</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      @endsection <!-- 追記 -->
