<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang quản lý')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-4 bg-light">
    <div class="container">
        <h1 class="mb-4 text-center text-success">Hệ thống Quản lý Sản phẩm</h1>

        {{-- Nội dung từng trang --}}
        @yield('content')
    </div>
</body>
</html>
