<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>

<h2>แก้ไขสินค้า</h2>

<form action="/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>ชื่อสินค้า</label><br>
    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <label>จำนวน</label><br>
    <input type="number" name="quantity" value="{{ $product->quantity }}"><br><br>

    <label>คำอธิบาย</label><br>
    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <label>รูป</label><br>
    @if($product->image)
        <img src="/images/{{ $product->image }}" width="100"><br>
    @endif
    <input type="file" name="image"><br><br>

    <button type="submit">อัปเดต</button>
</form>

</body>
</html>
