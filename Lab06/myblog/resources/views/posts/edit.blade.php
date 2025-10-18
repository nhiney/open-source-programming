@extends('layouts.app')

@section('title', 'Chỉnh sửa Bài Viết')
@section('page-title', 'Chỉnh sửa Bài Viết')

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Bài viết</a></li>
<li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Chỉnh sửa: {{ $post->title }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tiêu đề</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                    class="form-control @error('title') is-invalid @enderror">
                @error('title')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nội dung</label>
                <textarea name="content" rows="6"
                    class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>
@endsection