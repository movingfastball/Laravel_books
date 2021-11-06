@extends('layouts.app')
@section('content')

    <div class="card-body">
        <div class="card-title">
            本のタイトル
        <div>

        <!--バリデーションエラーの表示で使用-->
        @include('common.errors')

        <!--本登録フォーム-->
        <form action="{{ url('books') }}" method="POST" class="form-horizontal">
            @csrf

            <!--本のタイトル-->
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="item_name" class="form-control">
                </div>
            </div>

            <!--本登録ボタン-->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!--すでに登録されている本のリスト-->

@endsection