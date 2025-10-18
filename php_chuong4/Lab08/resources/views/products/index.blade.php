@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Danh sách sản phẩm</h2>

    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">+ Thêm mới</a>

    @if(session('success'))
    <div style="color: green">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="8" width="100%">
    <tr>
        <th>Ảnh</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Tồn kho</th>
        <th>Danh mục</th>
        <th>Hành động</th> 
    </tr>
    @foreach($products as $p)
    <tr>
        <td>
            @if($p->image)
                <img src="{{ asset('storage/'.$p->image) }}" width="100">
            @else
                <i>Không có ảnh</i>
            @endif
        </td>
        <td>{{ $p->name }}</td>
        <td>{{ number_format($p->price) }} đ</td>
        <td>{{ $p->stock }}</td>
        <td>{{ $p->category->name }}</td>
        <td>
            <!-- Nút Sửa -->
            <a href="{{ route('products.edit', $p->id) }}">Sửa</a>

            <!-- Nút Xóa -->
            <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>



    {{ $products->links() }}
</div>
@endsection