@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card mt-5">
            <div class="card-header text-center">
                <h4>會員登入</h4>
            </div>
            <div class="card-body">
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus>
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

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            記住我
            </label>
        </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            登入
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('register') }}">還沒有帳號？註冊</a>
                <br>
                <a href="{{ route('password.request') }}">忘記密碼？</a>
            </div>
        </div>
    </div>
</div>
@endsection
