@extends('layouts.app')

@section('content')
<div class="container">
    <h1>服飾商品</h1>
    @if(isset($category))
        <h4>目前分類：{{ $category->name }}</h4>
    @endif
    <div class="mb-4">
        <h5>商品分類</h5>
        <div class="category-bar">
            <a href="{{ route('products.index') }}" class="category-link {{ !isset($currentCategory) ? 'active' : '' }}">全部</a>
            @foreach($categories as $category)
                <a href="{{ route('category.products', $category) }}" class="category-link {{ (isset($currentCategory) && $currentCategory->id == $category->id) ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3">
            <div class="card mb-3">
                <img src="{{ Storage::url($product->image) }}" 
                     alt="{{ $product->name }}" 
                     style="width: 100%; height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5>{{ $product->name }}</h5>
                    <p>${{ $product->price }}</p>
                    <a href="{{ url('/product/'.$product->id) }}" class="btn btn-primary">查看詳情</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection