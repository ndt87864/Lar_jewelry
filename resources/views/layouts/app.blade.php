<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <!-- Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap Icons từ CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body style="background-color: #CCCCCC;">
    <br>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="#">Quản lý</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav">
                        @if (Auth::check() && Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                                    <i class="bi bi-list"></i> Danh mục
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.products.index') }}">
                                    <i class="bi bi-box"></i> Sản phẩm
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.orders.index') }}">
                                    <i class="bi bi-receipt"></i> Đơn hàng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.reports.indexPayment') }}">
                                    <i class="bi bi-file-earmark-bar-graph"></i> Báo cáo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.users.index') }}">
                                    <i class="bi bi-person-circle"></i> Tài khoản
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('products.index') }}">
                                    <i class="bi bi-box"></i> Sản phẩm
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories.index') }}">
                                    <i class="bi bi-list"></i> Danh mục
                                </a>
                            </li>
                            @if (Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.cart.index') }}">
                                        <i class="bi bi-cart"></i>
                                        <span class="badge badge-pill badge-danger">{{ $cartCount > 0 ? $cartCount : 0 }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.orders.index') }}">
                                        <i class="bi bi-receipt"></i> Đơn hàng
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>

                @if (!Auth::check() || Auth::user()->role !== 'admin')
                    <!-- Form tìm kiếm -->
                    <form action="{{ route('products.search') }}" method="POST" class="mx-5 w-50">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="query" class="form-control" placeholder="Tìm kiếm sản phẩm..."
                                required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Tìm</button>
                            </div>
                        </div>
                    </form>
                @endif

                <!-- Thông tin người dùng -->
                <ul class="navbar-nav align-items-center ml-auto">
                    @if(Auth::check())
                        <li class="nav-item">
                            @if(Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Hình ảnh người dùng"
                                    style="max-width: 50px;">
                            @else
                                <img src="{{ asset('storage/products/no.jpg') }}" alt="No Image" class="card-img-top"
                                    style="height: 50px; object-fit: cover;">
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('showUser.show', Auth::user()->id) }}">Xin chào,
                                {{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="form-inline">
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">
                                    <i class="bi bi-box-arrow-right"></i>
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>

    <br>
    <div class="container" style="background-color: #f8f9fa;">
        @yield('content')
    </div>

    <!-- jQuery và Bootstrap JS từ CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Sử dụng Bootstrap's collapse function cho navbar
        $('.navbar-toggler').on('click', function () {
            $('#navbarNav').collapse('toggle');
        });
    </script>
</body>

</html>
