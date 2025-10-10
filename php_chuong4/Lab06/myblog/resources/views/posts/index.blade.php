@extends('layouts.app')
@section('title', 'Danh sách Bài Viết')
@section('page-title', 'Quản lý Bài Viết')
@section('breadcrumb-items')
<li class="breadcrumb-item active">Bài viết</li>
@endsection
@section('page-actions')
<a href="{{ route('posts.create') }}" class="btn btn-primary">
    <i class="fas fa-plus me-1"></i>Tạo bài viết mới
</a>
@endsection
@section('styles')
<style>
    .post-table tr:hover {
        background-color: #f8f9fa;
    }

    .action-buttons .btn {
        margin-right: 5px;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5 class="card-title mb-0">Tất cả bài viết</h5>
            </div>
            <div class="col-md-6">
                <form method="GET" action="{{ route('posts.index') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                            placeholder="Tìm kiếm bài viết..." value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
        <x-alert type="success" :message="session('success')" />
        @endif
        @if($posts->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5>Chưa có bài viết nào</h5>
            <p class="text-muted">Hãy tạo bài viết đầu tiên của bạn!</p>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Tạo bài viết
            </a>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover post-table">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Tác giả</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)

                    <tr>

                        <td>{{ $post->id }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}"
                                class="text-decoration-none text-dark fw-bold">
                                {{ Str::limit($post->title, 50) }}
                            </a>
                        </td>

                        <td>{{ $post->author }}</td>

                        <td>
                            <span class="badge bg-{{ $post->published_at ? 'success' : 'warning' }}">
                                {{ $post->published_at ? 'Đã xuất bản' : 'Bản nháp' }}
                            </span>
                        </td>
                        <td>

                            <span title="{{ $post->created_at->format('d/m/YH:i:s') }}">
                                {{ $post->created_at->diffForHumans() }}
                            </span>
                        </td>

                        <td class="action-buttons">

                            <a href="{{ route('posts.show', $post->id) }}"
                                class="btn btn-sm btn-info" title="Xem chi tiết">
                                <i class="fas fa-eye">Xem chi tiết</i>
                            </a>
                            <a href="{{ route('posts.edit', $post->id) }}"
                                class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                <i class="fas fa-edit">Chỉnh sửa</i>
                            </a>

                            <form action="{{ route('posts.destroy', $post->id) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">


                                @csrf

                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="fas fa-trash">
                                        Xóa
                                    </i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Hiển thị {{ $posts->firstItem() }} - {{ $posts->lastItem() }} của {{ $posts->total() }} kết quả
            </div>
            <nav>
                {{ $posts->links() }}
            </nav>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h6>Danh mục</h6>

            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="{{ route('posts.index') }}"
                        class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                        Tất cả danh mục
                    </a>
                    @foreach($categories as $category)
                    <a href="{{ route('posts.index', ['category' => $category->slug]) }}"
                        class="list-group-item list-group-item-action {{ request('category') == $category->slug ? 'active' : '' }}">
                        {{ $category->name }}

                        <span class="badge bg-primary rounded-pill float-end">

                            {{ $category->posts_count }}
                        </span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <!-- Post content -->
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý tìm kiếm
        const searchForm = document.querySelector('form');
        const searchInput = searchForm.querySelector('input[name="search"]');
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchForm.submit();
            }
        });
    });
</script>
@endsection