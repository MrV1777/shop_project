<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
</head>
<body>

<h2>รายการสินค้า</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>ชื่อ</th>
        <th>จำนวน</th>
        <th>รูป</th>
        <th>จัดการ</th>
    </tr>

    @foreach($products as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ $p->quantity }}</td>
        <td>
            @if($p->image)
                <img src="/images/{{ $p->image }}" width="60">
            @endif
        </td>
        <td>
            <a href="/product/{{ $p->id }}/edit">แก้ไข</a>

            <form action="/product/{{ $p->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('ลบจริงไหม?')">ลบ</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>
