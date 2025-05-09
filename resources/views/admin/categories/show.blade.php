@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>分類詳細</h3>
    <p>ID：{{ $category->id }}</p>
    <p>名稱：{{ $category->name }}</p>
    <p>Slug：{{ $category->slug }}</p>
    <p>描述：{{ $category->description }}</p>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">返回</a>
</div>
@endsection
