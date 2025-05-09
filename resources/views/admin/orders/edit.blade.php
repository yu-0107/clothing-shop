@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>編輯訂單</h3>
    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="status" class="form-label">狀態</label>
            <select name="status" id="status" class="form-control">
                <option value="pending" @if($order->status == 'pending') selected @endif>待處理</option>
                <option value="processing" @if($order->status == 'processing') selected @endif>處理中</option>
                <option value="completed" @if($order->status == 'completed') selected @endif>已完成</option>
                <option value="cancelled" @if($order->status == 'cancelled') selected @endif>已取消</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">儲存</button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">返回</a>
    </form>
</div>
@endsection
