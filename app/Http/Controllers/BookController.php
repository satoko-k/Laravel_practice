<?php

// こう指定すると↓この名前だけで読み込めるようになる
namespace App\Http\Controllers;  

use Illuminate\Http\Request;

//Bookモデルを使えるようにする
use App\Book;
//バリデーター バリデーションを使えるようにする
use Validator; 

class BookController extends Controller
{
    // 本の一覧表示部分
    public function index()
    {
        // return view('books');
        $books = Book::orderBy('created_at', 'asc')->paginate(3);
        return view('books', [
            'books' => $books
        ]);
        
    }
    
    
    // 更新画面の表示
    public function edit(Book $books)
    {
        //{books}id 値を取得 => Book $books id 値の1レコード取得
        return view('booksedit', ['book' => $books]);
    }
    
    
    

    
    //登録　store
    public function store(Request $request) {
        
         //バリデーション
            $validator = Validator::make($request->all(), [
                'item_name'   => 'required| min:3 | max:255',
                'item_number' => 'required | min:1 | max:3',
                'item_amount' => 'required | max:6',
                 'published'  => 'required',
            ]);
        
            //バリデーション:エラー 
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
            }
            
             // Eloquentモデル（登録処理）
            $books = new Book;
            $books->item_name = $request->item_name;
            // $books->item_number = '1';
            // $books->item_amount = '1000';
            // $books->published = '2017-03-07 00:00:00';
            
            $books->item_number =  $request->item_number;
            $books->item_amount =  $request->item_amount;
            $books->published =    $request->published;
            
            $books->save(); 
            return redirect('/');  
    }
    

    
    //更新update
    public function update(Request $request) 
    {
     //バリデーション 
         $validator = Validator::make($request->all(), [
            'id' => 'required',  //どのidかが必須
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
        
        //データ更新　　find　でidを検索
                $books = Book::find($request->id);
                $books->item_name   = $request->item_name;
                $books->item_number = $request->item_number;
                $books->item_amount = $request->item_amount;
                $books->published   = $request->published;
                $books->save();
                return redirect('/');
            
        
    }
    
    // 削除
     public function destroy(Book $book)
     {
        $book->delete();
        return redirect('/');  

     }
    
    
    
    
    
}
