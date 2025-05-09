@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h4>會員註冊</h4>
            </div>
            <div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">姓名</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
        </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
        </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">密碼</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
        </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">確認密碼</label>
                        <input id="password_confirmation" type="password" class="form-control"
                               name="password_confirmation" required>
        </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            註冊
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('login') }}">已經有帳號？登入</a>
            </div>
        </div>
    </div>
</div>
@endsection
