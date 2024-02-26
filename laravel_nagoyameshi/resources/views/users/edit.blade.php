@extends('layouts.app')
 
 @section('content')
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-5 mt-3">
             <span>
                 <a href="{{ route('mypage') }}">マイページ</a> > 会員情報の編集
             </span>
 
             <h1 class="mt-3 mb-3">会員情報の編集/削除</h1>
             <hr>
 
             <form method="POST" action="{{ route('mypage.update') }}">
                 @csrf
                 <input type="hidden" name="_method" value="PUT">
                 <div class="form-group">
                     <div class="d-flex justify-content-between">
                         <label for="name" class="text-md-left mb-2">氏名</label>
                     </div>
                     <div>
                         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus >
                         @error('name')
                         <span class="invalid-feedback" role="alert">
                             <strong>氏名を入力してください</strong>
                         </span>
                         @enderror
                     </div>
                 </div>
                 
                 <br>

                 <div class="form-group">
                     <div class="d-flex justify-content-between">
                         <label for="name" class="text-md-left mb-2">ふりがな</label>
                     </div>
                     <div>
                         <input id="furigana" type="text" class="form-control @error('furigana') is-invalid @enderror" name="furigana" value="{{ $user->furigana }}" required autocomplete="name" autofocus>
                         @error('furigana')
                         <span class="invalid-feedback" role="alert">
                             <strong>ふりがなを入力してください</strong>
                         </span>
                         @enderror
                     </div>
                 </div>

                 <br>
 
                 <div class="form-group">
                     <div class="d-flex justify-content-between">
                         <label for="email" class="text-md-left mb-2">メールアドレス</label>
                     </div>
                     <div>
                         <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                         @error('email')
                         <span class="invalid-feedback" role="alert">
                             <strong>メールアドレスを入力してください</strong>
                         </span>
                         @enderror
                     </div>
                 </div>

                 <br>
 
                 <div class="form-group">
                     <div class="d-flex justify-content-between">
                         <label for="phone" class="text-md-left mb-2">電話番号</label>
                     </div>
                     <div>
                         <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>
                         @error('phone')
                         <span class="invalid-feedback" role="alert">
                             <strong>電話番号を入力してください</strong>
                         </span>
                         @enderror
                     </div>
                 </div>
 
                 <hr>

                 <button type="submit" class="btn btn-primary mt-3 w-25">
                     保存
                 </button>
             </form>
         </div>
     </div>
 </div>
 @endsection