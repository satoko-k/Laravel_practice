@extends('layouts.app') 　<!--親のベースになるテンプレート-->


@section('content')
<div class="row container">
    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('books/update') }}" method="POST">

        <!-- item_name -->
        <div class="form-group">
           <label for="item_name">本の名前Title</label>
           <input type="text" name="item_name" class="form-control" value="{{$book->item_name}}">
           <!--$book 　Bookモデル　$booksの１レコードを$bookで受け取っている-->
        </div>
        <!--/ item_name -->
        
         <!-- item_amount -->
        <div class="form-group">
           <label for="item_amount">金額Amount</label>
        <input type="text" name="item_amount" class="form-control" value="{{$book->item_amount}}">
        </div>
        <!--/ item_amount -->
        
        
        <!-- item_number -->
        <div class="form-group">
           <label for="item_number">数Number</label>
        <input type="text" name="item_number" class="form-control" value="{{$book->item_number}}">
        </div>
        <!--/ item_number -->


        
        <!-- published -->
        <div class="form-group">
           <label for="published">公開日published</label>
            <input type="datetime" name="published" class="form-control" value="{{$book->published}}"/>
        </div>
        <!--/ published -->
        
        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                戻る
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
         
         <!-- id値を送信 -->
         <input type="hidden" name="id" value="{{$book->id}}">
         <!--/ id値を送信 -->
         
         <!-- CSRF -->
         @csrf
         <!--/ CSRF -->
         
    </form>
    </div>
</div>
@endsection
