@extends('layouts.app')

@section('title', 'Tạo bài viết')
@push('styles')
<style>
    form {
        max-width: 600px;
        background: #f9fafb;
        padding: 16px;
        border-radius: 8px;
    }

    h2 {
        color: #1e40af;

        margin-bottom: 12px;
    }
</style>
@endpush
@section('content')
<h2>Tạo bài viết mới</h2>
@include('partials.breadcrumb')

<x-alert type="warning" title="Lưu ý">
    Dữ liệu hiện chỉ mô phỏng (chưa lưu DB).
</x-alert>

{{--@if(session('success'))
    <x-alert type="success" title="Thành công">
        {{ session('success') }}
</x-alert>
@endif--}}

<form action="{{ route('articles.store') }}" method="POST" style="margin-top: 16px;">
    @csrf

    <x-input name="title" label="Tiêu đề" />
    <label style="display:block;margin:8px 0 4px;">Nội dung</label>
    <textarea
        name="body"
        rows="5"
        style="width:100%;padding:8px;border:1px solid #e5e7eb;border-radius:6px;">{{ old('body') }}</textarea>
    @error('body')
    <div style="color:#991B1B;margin-top:4px;">
        {{ $message }}
    </div>
    @enderror
    <button
        type="submit" style="margin-top:10px;padding:8px 16px;border:none;background:#2563eb;color:white;border-radius:6px;cursor:pointer;">
        Lưu
    </button>

</form>

@endsection
