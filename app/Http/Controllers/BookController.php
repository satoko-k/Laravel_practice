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
    //
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
    
    
    
    
    
}
