<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Blog') - Laravel App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: calc(100vh - 56px);
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }

        .main-content {
            min-height: calc(100vh - 56px);
        }

        .navbar-brand {
            font-weight: bold;
        }
    </style>
    @stack('styles')
    @yield('head')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('posts.index') }}">
                <i class="fas fa-blog me-2"></i>My Blog
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.index')? 'active' : '' }}"
                            href="{{ route('posts.index') }}">
                            <i class="fas fa-home me-1"></i>Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posts.create')? 'active' : '' }}"
                            href="{{ route('posts.create') }}">
                            <i class="fas fa-plus me-1"></i>Tạo bài viết
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu">

                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Cài đặt</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2">
                                        </i>Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Đăng nhập
                        </a>
                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i>Đăng ký
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-none d-md-block p-3">
                <div class="list-group">
                    <a href="{{ route('posts.index') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                        <i class="fas fa-list me-2"></i>Danh sách bài viết
                    </a>
                    <a href="{{ route('posts.create') }}"
                        class="list-group-item list-group-item-action {{ request()->routeIs('posts.create') ? 'active' : '' }}">
                        <i class="fas fa-plus me-2"></i>Tạo bài viết mới

                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-users me-2"></i>Quản lý người dùng
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-chart-bar me-2"></i>Thống kê
                    </a>
                </div>
                <div class="mt-4">
                    <h6 class="text-muted">Bài viết gần đây</h6>
                    <div class="list-group">
                        @foreach(\App\Models\Post::latest()->take(5)->get() as $recentPost)
                        <a href="{{ route('posts.show', $recentPost->id) }}"
                            class="list-group-item list-group-item-action small">
                            <div class="d-flex w-100 justify-content-between">
                                <span>{{ Str::limit($recentPost->title, 25)}}</span>
                                <small>{{ $recentPost->created_at->diffForHumans() }}</small>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <div class="container-fluid mt-4">
                    <!-- Breadcrumb -->
                    @section('breadcrumb')
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Trang chủ</a></li>
                            @yield('breadcrumb-items')
                        </ol>
                    </nav>
                    @show
                    <!-- Page Title -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0">@yield('page-title')</h2>
                        @yield('page-actions')
                    </div>
                    <!-- Content -->
                    <div class="row">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">
                &copy; 2024 My Blog. All rights reserved. |
                <i class="fas fa-code"></i> Made with Laravel
            </p>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-dismiss alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[data-dismiss="alert"]');
            alerts.forEach(alert => {
                alert.addEventListener('click', function() {
                    this.closest('.alert').style.display = 'none';
                });
            });
            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                document.querySelectorAll('.alert').forEach(alert => {
                    if (alert.getAttribute('data-dismissible') !== 'false') {
                        alert.style.display = 'none';
                    }
                });
            }, 5000);
        });
    </script>
    @stack('scripts')
    @yield('scripts')
</body>

</html>