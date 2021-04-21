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
Route::get('/',  'BookController@index');

/**
* 本を追加 
*/
Route::post('/books',  'BookController@store');
    // dd( $request );
    


//更新画面
    Route::post('/booksedit/{books}', 'BookController@edit');

//更新処理
    Route::post('/books/update', 'BookController@update');

//  本を削除 

    Route::delete('/book/{book}', 'BookController@destroy');



?>