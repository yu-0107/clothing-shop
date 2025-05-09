@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>訂單詳細</h3>
    <p>訂單編號：{{ $order->id }}</p>
    <p>用戶：{{ $order->user->name ?? '已刪除' }}</p>
    <p>金額：${{ number_format($order->total, 2) }}</p>
    <p>狀態：{{ $order->status }}</p>
    <p>建立時間：{{ $order->created_at }}</p>
    <h5>商品明細：</h5>
    <ul>
        @foreach($order->items as $item)
            <li>{{ $item->product->name ?? '已刪除商品' }} x {{ $item->quantity }}</li>
        @endforeach
    </ul>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">返回</a>
</div>
@endsection
