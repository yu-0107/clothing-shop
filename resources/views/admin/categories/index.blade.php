@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">分類管理</h6>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">新增分類</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>名稱</th>
                            <th>Slug</th>
                            <th>描述</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-primary btn-sm">檢視</a>
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-secondary btn-sm">編輯</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除這個分類嗎？')">刪除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
