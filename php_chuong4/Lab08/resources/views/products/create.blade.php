@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thêm sản phẩm mới</h2>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Tên sản phẩm:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br>

        <label>Giá:</label><br>
        <input type="number" name="price" value="{{ old('price') }}"><br>

        <label>Tồn kho:</label><br>
        <input type="number" name="stock" value="{{ old('stock') }}"><br>

        <label>Danh mục:</label><br>
        <select name="category_id">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select><br>

        <label>Ảnh sản phẩm:</label><br>
        <input type="file" name="image"><br>

        <button type="submit">Lưu</button>
    </form>
</div>
@endsection
