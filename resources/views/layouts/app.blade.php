<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>服飾電商平台</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        @stack('styles')
        <style>
            .category-bar {
                display: flex;
                gap: 10px;
                margin-bottom: 1rem;
                flex-wrap: wrap;
            }
            .category-link {
                padding: 6px 18px;
                border-radius: 20px;
                background: #f5f5f5;
                color: #333;
                text-decoration: none;
                transition: background 0.2s, color 0.2s;
                border: 1px solid #e0e0e0;
                font-size: 1rem;
            }
            .category-link.active, .category-link:hover {
                background: #333;
                color: #fff;
                border-color: #333;
            }
            .product-thumb {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-top-left-radius: 0.375rem;
                border-top-right-radius: 0.375rem;
            }
            .product-card {
                border: 1px solid #e0e0e0;
                border-radius: 0.375rem;
                transition: box-shadow 0.2s;
            }
            .product-card:hover {
                box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            }
            .card-title {
                font-size: 1.1rem;
                font-weight: 600;
            }
        </style>
    </head>
    <body>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">服飾電商</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">首頁</a>
                        </li>
                        {{-- 商品分類下拉選單（可選） --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
                                商品分類
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('products.index') }}">全部</a></li>
                                @foreach(\App\Models\Category::all() as $category)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('category.products', $category) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart" style="font-size: 1.3rem;"></i>
                                @php $cart = session('cart', []); @endphp
                                @if(count($cart) > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ count($cart) }}
                                        <span class="visually-hidden">cart items</span>
                                    </span>
                                @endif
                            </a>
                        </li>
                        @auth
                            <!-- 會員下拉選單 -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('orders.user') }}">
                                            <i class="bi bi-receipt"></i> 我的訂單
                                        </a>
                                    </li>
                                    <!-- 你可以在這裡加更多會員功能 -->
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item">登出</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">登入</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">註冊</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if(session('success'))
        <script>
            Swal.fire({
                title: '成功！',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: '確定'
            });
        </script>
        @endif
    </body>
</html>
