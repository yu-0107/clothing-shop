@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="mb-4">結帳</h2>
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="receiver_name" class="form-label">收件人姓名</label>
                            <input type="text" class="form-control" id="receiver_name" name="receiver_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="receiver_phone" class="form-label">收件人電話</label>
                            <input type="text" class="form-control" id="receiver_phone" name="receiver_phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="receiver_address" class="form-label">收件人地址</label>
                            <input type="text" class="form-control" id="receiver_address" name="receiver_address" required>
                        </div>
                        <div class="mb-4">
                            <h5>訂單明細</h5>
                            <ul class="list-group mb-2">
                                @php $total = 0; @endphp
                                @foreach($cartProducts as $product)
                                    @php
                                        $subtotal = $product->price * $cart[$product->id];
                                        $total += $subtotal;
                                    @endphp
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            {{ $product->name }} x {{ $cart[$product->id] }}
                                        </span>
                                        <span>${{ number_format($product->price * $cart[$product->id], 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-end fw-bold fs-5">
                                總計：${{ number_format($total, 2) }}
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">送出訂單</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
