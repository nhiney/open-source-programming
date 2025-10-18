<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Lab07')</title>
    <style>
         body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            margin: 0;
            background-color: #fff;
            color: #111827;
        }

        .container {
            max-width: 960px;
            margin: 24px auto;
            padding: 0 16px;
        }

        .flash {
            padding: 10px;
            margin-bottom: 12px;
            background: #ECFDF5;
            color: #065F46;
            border-radius: 8px;
        }

        nav a {
            margin-right: 12px;
            color: #fff;
            text-decoration: none;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 12px;
        }

        th, td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.nav')
    <div class="container">
        @if(session('success'))
            <x-alert type="success" title="Thành công">{{ session('success') }}</x-alert>
        @endif

        @yield('content')
    </div>
    @include('partials.footer')
    @include('partials.breadcrumb')
    @stack('scripts')
</body>
</html>
