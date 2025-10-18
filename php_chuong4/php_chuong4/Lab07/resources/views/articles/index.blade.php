@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
    <h2>Danh sách bài viết</h2>

    @if(session('success'))
        <x-alert type="success" title="Thành công">
            {{ session('success') }}
        </x-alert>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $a)
                <tr>
                    <td>{{ $a['id'] }}</td>
                    <td>{{ $a['title'] }}</td>
                    <td>{{ $a['body'] ?? '-' }}</td>
                    <td>
                        <a href="{{ route('articles.show', $a['id']) }}">Xem</a> |
                        <a href="{{ route('articles.edit', $a['id']) }}">Sửa</a> |
                        <form action="{{ route('articles.destroy', $a['id']) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc muốn xoá bài viết này?')">Xoá</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;">Chưa có bài viết nào.</td>
                </tr>
            @endforelse
        </tbody>
        </tbody>
    </table>

    <div style="margin-top:16px;">
        <a href="{{ route('articles.create') }}">+ Thêm bài viết mới</a>
    </div>
@endsection

@push('scripts')
<script>
    console.log('Articles index loaded');
</script>
@endpush
