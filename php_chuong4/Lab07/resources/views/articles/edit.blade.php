@extends('layouts.app')

@section('title', 'Sửa bài viết')
@push('styles')
<style>
    form {
        max-width: 600px;
        background: #fef2f2;
        padding: 16px;
        border-radius: 8px;
    }

    h2 {
        color: #b91c1c;
        margin-bottom: 12px;
    }
</style>
@endpush
@section('content')
<h2>Sửa bài viết #{{ $article['id'] }}</h2>

{{--
@if(session('success'))
    <x-alert type="success" title="Thành công">
        {{ session('success') }}
</x-alert>
@endif
--}}


<form action="{{ route('articles.update', $article['id']) }}" method="POST" style="margin-top: 16px;">
    @csrf
    @method('PUT')

    <x-input name="title" label="Tiêu đề" :value="$article['title']" />

    <label style="display:block;margin:8px 0 4px;">Nội dung</label>
    <textarea
        name="body"
        rows="5"
        style="width:100%;padding:8px;border:1px solid #e5e7eb;border-radius:6px;">{{ old('body', $article['body']) }}</textarea>
    @error('body')
    <div style="color:#991B1B;margin-top:4px;">{{ $message }}</div>
    @enderror

    <button
        type="submit"
        style="margin-top:12px;padding:8px 16px;border:none;background:#16a34a;color:white;border-radius:6px;">
        Cập nhật
    </button>
</form>
@endsection