@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">商品管理</h6>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> 新增商品
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <h5>商品分類</h5>
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item">
                            <a href="{{ route('category.products', $category) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>圖片</th>
                            <th>名稱</th>
                            <th>價格</th>
                            <th>庫存</th>
                            <th>狀態</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" style="max-width: 50px; max-height: 50px;">
                                @else
                                    <span>無圖片</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge bg-success">有庫存</span>
                                @else
                                    <span class="badge bg-danger">無庫存</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> 編輯
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除這個商品嗎？')">
                                        <i class="fas fa-trash"></i> 刪除
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
