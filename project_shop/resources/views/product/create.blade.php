<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>

<h2>เพิ่มสินค้า</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="/product/store" method="POST" enctype="multipart/form-data">
    @csrf

    <label>ชื่อสินค้า</label><br>
    <input type="text" name="name"><br><br>

    <label>จำนวน</label><br>
    <input type="number" name="quantity"><br><br>

    <label>คำอธิบาย</label><br>
    <textarea name="description"></textarea><br><br>

    <label>รูปสินค้า</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit">บันทึก</button>
</form>

</body>
</html>
