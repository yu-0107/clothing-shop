@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">用戶管理</h6>
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
                            <th>姓名</th>
                            <th>Email</th>
                            <th>管理員</th>
                            <th>註冊時間</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="badge bg-success">是</span>
                                @else
                                    <span class="badge bg-secondary">否</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary btn-sm">檢視</a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-secondary btn-sm">編輯</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('確定要刪除這個用戶嗎？')">刪除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
