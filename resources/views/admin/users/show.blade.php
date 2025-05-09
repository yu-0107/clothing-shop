@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>用戶詳細</h3>
    <p>ID：{{ $user->id }}</p>
    <p>姓名：{{ $user->name }}</p>
    <p>Email：{{ $user->email }}</p>
    <p>管理員：{{ $user->is_admin ? '是' : '否' }}</p>
    <p>註冊時間：{{ $user->created_at }}</p>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">返回</a>
</div>
@endsection
