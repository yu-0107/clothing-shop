@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ Storage::url($product->image) }}" class="img-fluid" alt="{{ $product->name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p>分類：{{ $product->category->name }}</p>
            <p>{{ $product->description }}</p>
            <h4>${{ $product->price }}</h4>
            <form action="{{ route('cart.add') }}" method="POST" class="mb-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="input-group mb-2" style="max-width: 200px;">
                    <input type="number" name="quantity" value="1" min="1" class="form-control">
                    <button class="btn btn-success" type="submit">加入購物車</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection