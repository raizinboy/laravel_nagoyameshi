@extends('layouts.app')

@section('content')
<div class="container mb-3">
    <h1 class="ps-1 pt-2">店舗一覧</h1>
    <form class="row g-1" action="{{ route('shops.index') }}" method="GET">
        <div class="col-md-2">
            <input class="form-control ms-1 mb-3" placeholder="店名">
        </div>
        <div class="col-md-2 me-2">
            <select name="category" class="form-control ms-1 mb-3 pe-3" placeholder="全カテゴリー">
                    <option value="">全カテゴリー</option>
                    @foreach($categories as $category) 
                        @if($category_id == $category->id)
                            <option value="{{ $category->id }}" selected>{{$category->name}}</option>
                        @else 
                            <option value="{{ $category->id }}">{{$category->name}}</option>  
                        @endif
                    @endforeach
            </select>
        </div>   
        <div class="row col-md-3">
            <div class="col-md-3 p-0">
                <button type="submit" class="btn mt-1"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <div>
            <div class="col-md-9 ps-1 pt-2 pb-2">
                Sort By
                @sortablelink('furigana', '名前')
            </div>
        </div>
    </form>
    <!--sort挿入箇所 -->

    @foreach($shops as $shop)
    <div class="d-flex flex-column mb-3 row w-100 ms-3">
        <div class="card col-md-12 row d-flex flex-row ps-0 pe-0 justify-content-end">
            <div class="col-md-4 mt-2 mb-2 ps-2">
                <a href="{{ route('shops.show', $shop->id) }}">
                    @if ($shop->image !== "")
                    <img src="{{ asset($shop->image) }}" class="img-thumbnail">
                    @else
                    <img src="{{ asset('img/sample1.jpeg') }}" class="img-thumbnail" alt="サンプル画像">
                    @endif
                </a>
            </div>
            <div class="card-body col-md-8">
                <div class="row col-md-12 h-100">
                    <div class="col-md-10 h-100">    
                        <h2 class="card-title fw-bold">{{ $shop->name }}<span class="review-score-color ms-5">★ {{ $review_average_lists[$shop->id] }}</span></h2>
                        <div>
                            <h4>カテゴリー：{{ $shop->category->name }}</h4>
                            <p class="mb-0">＜説明＞</p>
                            <p>{{ $shop->description }}</p>
                        </div>
                    </div>
                    
                    <div class="col-md-2 h-100 d-flex align-items-center justify-content-center">
                        <a href="{{ route('shops.show', $shop->id) }}" class="btn btn-primary d-flex align-items-center">店舗詳細</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="mb-5">
      {{ $shops->links() }}
    </div>
</div>
@endsection