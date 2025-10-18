@extends('layouts.app')

@section('title', $post->title)
@section('page-title', 'Chi tiết Bài Viết')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Bài viết</a></li>
<li class="breadcrumb-item active">{{ Str::limit($post->title, 30) }}</li>
@endsection

@section('page-actions')
@can('update', $post)
<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning me-2">
    <i class="fas fa-edit"></i> Chỉnh sửa
</a>
@endcan
@can('delete', $post)
<form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
    onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="fas fa-trash"></i> Xóa
    </button>
</form>
@endcan
@endsection

@section('content')
<div class="row">
    <!-- Nội dung bài viết -->
    <div class="col-md-9">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $post->title }}</h5>
                <span class="badge bg-{{ $post->published_at ? 'success' : 'warning' }}">
                    {{ $post->published_at ? 'Đã xuất bản' : 'Bản nháp' }}
                </span>
            </div>
            <div class="card-body">
                <p class="text-muted mb-2">
                    <i class="fas fa-user"></i> {{ $post->author }}
                    &nbsp; | &nbsp;
                    <i class="fas fa-clock"></i>
                    {{ $post->created_at->format('d/m/Y H:i') }}
                </p>
                <hr>
                <div class="post-content">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar danh mục -->
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
</div>
@endsection