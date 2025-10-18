<form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name" value="{{ old('name', $product->name) }}"><br>

    <label>Giá:</label><br>
    <input type="number" name="price" value="{{ old('price', $product->price) }}"><br>

    <label>Tồn kho:</label><br>
    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"><br>

    <label>Danh mục:</label><br>
    <select name="category_id">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select><br>

    <label>Ảnh hiện tại:</label><br>
    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" width="120">
    @else
        <i>Chưa có ảnh</i>
    @endif
    <br>

    <label>Ảnh mới (nếu muốn thay):</label><br>
    <input type="file" name="image"><br>

    <button type="submit">Cập nhật</button>
</form>
