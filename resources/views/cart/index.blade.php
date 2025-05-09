@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">購物車</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) == 0)
        <div class="text-center py-5">
            <p class="mb-4">購物車是空的。</p>
            <a href="{{ url('/') }}" class="btn btn-primary">繼續購物</a>
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="align-middle">商品</th>
                            <th class="align-middle">數量</th>
                            <th class="align-middle">單價</th>
                            <th class="align-middle">小計</th>
                            <th class="align-middle">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($products as $product)
                            @php
                                $subtotal = $product->price * $cart[$product->id];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" style="width:60px; height:60px; object-fit:cover; border-radius:6px; margin-right:10px;">
                                        @endif
                                        <div>
                                            <div>{{ $product->name }}</div>
                                            <div class="text-muted" style="font-size:0.9em;">商品編號: {{ $product->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-outline-secondary cart-btn-big" onclick="changeQty({{ $product->id }}, -1)">-</button>
                                        <input type="number" min="1" class="form-control text-center mx-2 cart-qty-input" id="qty-{{ $product->id }}" value="{{ $cart[$product->id] }}" style="width:70px;">
                                        <button type="button" class="btn btn-outline-secondary cart-btn-big" onclick="changeQty({{ $product->id }}, 1)">+</button>
                                    </div>
                                </td>
                                <td class="align-middle" id="price-{{ $product->id }}">${{ number_format($product->price, 2) }}</td>
                                <td class="align-middle" id="subtotal-{{ $product->id }}">${{ number_format($subtotal, 2) }}</td>
                                <td class="align-middle">
                                    <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i> 移除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="table-light">
                            <td colspan="3" class="text-end"><strong>總計</strong></td>
                            <td><strong id="cart-total">${{ number_format($total, 2) }}</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ url('/') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> 繼續購物
            </a>
            <a href="#" class="btn btn-primary" onclick="submitCartUpdate(event)">前往結帳 <i class="fas fa-arrow-right"></i></a>
        </div>

        <form id="cart-update-form" action="{{ route('cart.update') }}" method="POST" style="display:none;">
            @csrf
            @foreach($products as $product)
                <input type="hidden" name="quantities[{{ $product->id }}]" id="form-qty-{{ $product->id }}" value="{{ $cart[$product->id] }}">
            @endforeach
        </form>
    @endif
</div>

@push('styles')
<style>
/* 移除數字輸入框的上下箭頭 */
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}

.quantity-input {
    text-align: center;
    width: 60px !important;
}

.input-group {
    width: auto !important;
}


</style>
@endpush

@push('scripts')
<script>
function changeQty(productId, delta) {
    const input = document.getElementById('qty-' + productId);
    let value = parseInt(input.value) || 1;
    value += delta;
    if (value < 1) value = 1;
    input.value = value;
    // 可選：即時更新小計
    updateSubtotal(productId, value);
}

function updateSubtotal(productId, qty) {
    const price = parseFloat(document.getElementById('price-' + productId).innerText.replace('$',''));
    document.getElementById('subtotal-' + productId).innerText = '$' + (price * qty).toFixed(2);
    // 可選：即時更新總計
    updateTotal();
}

function updateTotal() {
    let total = 0;
    document.querySelectorAll('.cart-qty-input').forEach(input => {
        const productId = input.id.replace('qty-', '');
        const price = parseFloat(document.getElementById('price-' + productId).innerText.replace('$',''));
        total += price * parseInt(input.value);
    });
    document.getElementById('cart-total').innerText = '$' + total.toFixed(2);
}

function submitCartUpdate(e) {
    e.preventDefault();
    // 將前端 input 的數量同步到隱藏表單
    document.querySelectorAll('.cart-qty-input').forEach(input => {
        const productId = input.id.replace('qty-', '');
        document.getElementById('form-qty-' + productId).value = input.value;
    });
    document.getElementById('cart-update-form').submit();
}
</script>
@endpush
@endsection
