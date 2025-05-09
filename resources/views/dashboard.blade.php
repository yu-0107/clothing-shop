@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="alert alert-success text-center">
        恭喜，您已成功登入！
                </div>
    <div class="text-center">
        <a href="{{ url('/') }}" class="btn btn-primary">回到首頁</a>
    </div>
</div>
@endsection
