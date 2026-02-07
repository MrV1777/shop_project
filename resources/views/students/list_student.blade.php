<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <title>ຄົ້ນຫາຂໍ້ມູນນັກສຶກສາ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-7xl mx-auto bg-white shadow-xl rounded-2xl p-6">

    <!-- หัวข้อ -->
    <h1 class="text-center text-2xl font-bold mb-6">
        ຄົ້ນຫາຂໍ້ມູນນັກສຶກສາ
    </h1>

    <!-- ปุ่ม + ค้นหา -->
    <div class="flex flex-wrap justify-between items-center gap-3 mb-5">

        <div class="flex gap-2">
            <a href="{{ route('students.index') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">
                ⬅ ກັບໜ້າຫຼັກ
            </a>

            <a href="{{ route('students.create') }}"
               class="bg-yellow-400 text-black px-4 py-2 rounded-lg shadow">
                ✏ ສ້າງຂໍ້ມູນ
            </a>
        </div>

        <form method="GET" class="flex gap-2">
            <input type="text" name="search"
                   class="border rounded-lg px-3 py-2 w-64"
                   placeholder="ຄົ້ນຫາ...">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                🔍 ຄົ້ນຫາ
            </button>
        </form>

    </div>

    <p class="mb-3 text-gray-600">
        ພົບຂໍ້ມູນນັກຮຽນ ({{ $students->count() }} ລາຍການ)
    </p>

    <!-- ตาราง -->
    <div class="overflow-x-auto">
        <table class="w-full border border-blue-500 text-center">
            <thead class="bg-green-100 border-b-2 border-blue-500">
            <tr>
                <th class="border px-3 py-2">ລະດັບ</th>
                <th class="border px-3 py-2">ຊື່</th>
                <th class="border px-3 py-2">ນາມສະກຸນ</th>
                <th class="border px-3 py-2">ເພດ</th>
                <th class="border px-3 py-2">ຕົວເລືອກ</th>
            </tr>
            </thead>

            <tbody>
            @foreach($students as $index => $student)
                <tr class="hover:bg-gray-100">
                    <td class="border px-3 py-2">{{ $index + 1 }}</td>
                    <td class="border px-3 py-2">{{ $student->first_name }}</td>
                    <td class="border px-3 py-2">{{ $student->last_name }}</td>
                    <td class="border px-3 py-2">
                        @if($student->gender == 'male')
                            ຊາຍ
                        @elseif($student->gender == 'female')
                            ຍິງ
                        @else
                            ອື່ນໆ
                        @endif
                    </td>
                    <td class="border px-3 py-2">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('students.show', $student->id) }}"
                               class="bg-cyan-500 text-white px-3 py-1 rounded">
                                👁 ລາຍລະອຽດ
                            </a>

                            <a href="{{ route('students.edit', $student->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded">
                                ✏ ແກ້ໄຂ
                            </a>

                            <form method="POST"
                                  action="{{ route('students.destroy', $student->id) }}"
                                  onsubmit="return confirm('ຢືນຢັນການລົບ?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded">
                                    🗑 ລົບ
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
