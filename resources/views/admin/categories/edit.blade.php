@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>編輯分類</h3>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">名稱</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">描述</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $category->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">儲存</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">返回</a>
    </form>
</div>
@endsection
