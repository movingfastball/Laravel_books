<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book; //Bookモデルを使えるようにする
use Validator; //バリデーションモデルを使用できるようにする
use Auth; //認証モデルを使用する


class BooksController extends Controller
{
    public function index(){
        $books = Book::orderBy('created_at', 'asc')->get();
        return view('books', ['books' => $books]);
    }

    public function edit(Book $books){
        return view('booksedit',['book' => $books]);
    }

    public function update(Request $request){
            //バリデーション
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'item_name' => 'required|min:3|max:255',
                'item_number' => 'required|min:1|max:3',
                'item_amount' => 'required|max:6',
                'published' => 'required',
        ]);

        //バリデーション:エラー
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        
        //データ更新
        $books = Book::find($request->id);
        $books->item_name   = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published   = $request->published;
        $books->save();

        return redirect('/');
    }

    public function store(Request $request){
        //バリデーション
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required | min:1 | max:3 | ',
            'item_amount' => 'required | max:6 | ',
            'published'   => 'required',
        ]);
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        // Eloquentモデル（登録処理）
        $books = new Book;
        $books->item_name =    $request->item_name; //本のタイトル
        $books->item_number =  $request->item_number; //数
        $books->item_amount =  $request->item_amount; //金額
        $books->published =    $request->published; //公開日
        $books->save(); 
        return redirect('/');
    }

    public function destroy(Book $book){
        $book->delete();
        return redirect('/');
    }

}
