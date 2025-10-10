@extends('layouts.app')

@section('title', 'Chi tiết bài viết')

@section('content')
<h2>{{ $article->title }}</h2>
<p>{{ $article->body }}</p>

<a href="{{ route('articles.index') }}">← Quay lại danh sách</a>
@endsection
