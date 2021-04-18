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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Book;
use Illuminate\Http\Request;

/**
* 本の一覧表示(books.blade.php)
*/
Route::get('/', function () {
    // return view('books');
    
    $books = Book::orderBy('created_at', 'asc')->get();
    return view('books', [
        'books' => $books
    ]);
});

/**
* 本を追加 
*/
Route::post('/books', function (Request $request) {
    // dd( $request );
    
    //
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
    
});



//更新画面
    Route::post('/booksedit/{books}', function(Book $books) {
        //{books}id 値を取得 => Book $books id 値の1レコード取得
        return view('booksedit', ['book' => $books]);
    });

//更新処理
    Route::post('/books/update', function(Request $request){
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
});








/**
* 本を削除 
*/
Route::delete('/book/{book}', function (Book $book) {
    $book->delete();
    return redirect('/');  
});


?>