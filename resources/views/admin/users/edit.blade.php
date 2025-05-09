@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>編輯用戶</h3>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">姓名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="is_admin" class="form-label">管理員</label>
            <select name="is_admin" id="is_admin" class="form-control">
                <option value="0" @if(!$user->is_admin) selected @endif>否</option>
                <option value="1" @if($user->is_admin) selected @endif>是</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">儲存</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">返回</a>
    </form>
</div>
@endsection
