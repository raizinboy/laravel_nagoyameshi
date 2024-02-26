@extends('layouts.app')

@section('content')    
<div class="container mb-5">
    <div class="row">
        <h1 class="display-1 pt-2 ms-2 col-md-9">{{ $shop->name }}</h1>
        @if($shop->isFavoritedBy(Auth::user()))
        <a href="{{ route('shops.favorite', $shop) }}" class="btn d-flex mt-4 mb-4  align-items-center favorite_btn col-md-2">
            <i class="fa fa-heart"></i>
            お気に入り解除
        </a>
        @else
        <a href="{{ route('shops.favorite', $shop) }}" class="btn d-flex mt-4 mb-4 align-items-center favorite_btn col-md-2">
            <i class="fa fa-heart"></i>
            お気に入り
        </a>
        @endif
    </div>
    <div class="card border-dark border-4 mb-5">
        <img src="{{ asset('img/sample1.jpeg') }}" class="card-img-top" alt="サンプル1">
        <div class="card-body">
            <h2 class="card-title ms-4">●{{ $shop->category->name }}</h2>
            <p class="card-text ms-4">　 {{ $shop->description }}</p>
            <h3 class="ms-4"> ●お店情報 </h6>
            <ul class="list-group list-group-flush ms-4">
                <li class="list-group-item">郵便番号：{{ $shop->postal_code }}</li>
                <li class="list-group-item">住所：{{ $shop->address }}</li>
                <li class="list-group-item">電話番号：{{ $shop->phone }}</li>
                <li class="list-group-item">営業時間：{{ $shop->business_hours }}</li>
                <li class="list-group-item">定休日：{{ $shop->regular_holiday }}</li>
                <li class="list-group-item">価格帯：{{ $shop->price }}</li>
            </ul>
            <h3 class="mt-3 ms-4 ">●みんなのレビュー <span class="ms-2">★{{ $review_average }}</span></h3>
            <div class="row">
                @foreach($reviews as $review)
                <div class="col-md-8 mt-3 ms-5 pt-2 ps-3 border border-dark border-2 rounded">
                    <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                    <p class="h3">{{ $review->content}}</p>
                    <label>{{ $review->created_at}} {{$review->user->name}}</label>
                </div>
                @endforeach
            </div><br>

            @auth
            <h3 class="mt-3 ms-4 ">●レビューを投稿（有料会員限定）</h3>
            <div class="row">
                <div class="col-md-8 ms-5 mt-3 ps-2 ">
                    <form method="POST" action="{{ route('review.store') }}">
                        @csrf
                        <h4>評価</h4>
                        <select name="score" class="form-control m-2 review-score-color">
                            <option value="5" class="review-score-color">★★★★★</option>
                            <option value="4" class="review-score-color">★★★★</option>
                            <option value="3" class="review-score-color">★★★</option>
                            <option value="2" class="review-score-color">★★</option>
                            <option value="1" class="review-score-color">★</option>
                        </select>
                        <h4>レビュー内容</h4>
                        @error('content')
                            <strong>レビュー内容を入力してください</strong>
                        @enderror
                        <textarea name="content" class="form-control me-5"></textarea>
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button type="submit" class="btn btn-primary mt-2">レビューを追加</button>
                    </form>
                </div>
            </div>
            @endauth
            <hr>
            <h3 class="mt-3 ms-4 ">●予約（有料会員限定）</h3>
            <div class="card-body d-flex justify-content-center">
                <a href="#" class="card-link btn btn-success col-md-6" >予約する</a>
            </div>
            </table>
        </div>
    </div>
</div>
@endsection