@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>新增分類</h3>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">名稱</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">描述</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">新增</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">返回</a>
    </form>
</div>
@endsection
