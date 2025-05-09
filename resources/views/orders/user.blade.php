@extends('layouts.app')

@section('content')
<div class="container">
    <h2>我的訂單</h2>
    <div class="mb-3">
        <a href="{{ url('/') }}" class="btn btn-outline-primary">
            <i class="bi bi-house-door"></i> 回首頁
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>訂單編號</th>
                <th>金額</th>
                <th>狀態</th>
                <th>建立時間</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>${{ number_format($order->total, 2) }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection
