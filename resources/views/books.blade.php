@extends('layouts.app')
@section('content')

    <div class="card-body">
        <div class="card-title">
            本のタイトル
        <div>

        <!--バリデーションエラーの表示で使用-->
        @include('common.errors')

        <!--本のタイトル-->
        <form action="{{ url('books') }}" method="POST" class="form-horizontal">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="book" class="col-sm-3 control-label">Book</label>
                    <input type="text" name="item_name" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="book" class="col-sm-3 control-label">金額</label>
                    <input type="text" name="item_amount" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="book" class="col-sm-3 control-label">数</label>
                    <input type="text" name="item_number" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="book" class="col-sm-3 control-label">公開日</label>
                    <input type="date" name="published" class="form-control">
                </div>
            </div>

            <!--本登録ボタン-->
            <div class="form-row">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>

        </form>
    </div>

    <!--すでに登録されている本のリスト-->
    @if(count($books) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>本一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td class="table-text">
                                <div>{{ $book->item_name }}</div>
                            </td>

                            <!--本:更新ボタン-->
                            <td>
                                <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">
                                        更新
                                    </button>
                                </form>
                            </td>

                            </td>
                            <!--本削除ボタン-->
                            <td>
                                <form action="{{ url('book/'.$book->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="coll-md-4 offset-md-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection