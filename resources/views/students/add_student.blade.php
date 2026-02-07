<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ເພີ່ມນັກຮຽນ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-pink-100 min-h-screen p-6">

    <div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-xl shadow-xl rounded-3xl p-8 border border-white/40">

        <h1 class="text-center text-3xl font-bold text-blue-700 mb-8">
            ເພີ່ມຂໍ້ມູນນັກຮຽນ
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="first_name" class="block text-gray-700 font-semibold mb-2">ຊື່</label>
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>

            <div>
                <label for="last_name" class="block text-gray-700 font-semibold mb-2">ນາມສະກຸນ</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
            </div>

            <div>
                <label for="gender" class="block text-gray-700 font-semibold mb-2">ເພດ</label>
                <select name="gender" id="gender"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                    <option value="">-- ເລືອກເພດ --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ຊາຍ</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>ຍິງ</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>ອື່ນໆ</option>
                </select>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">
                    💾 ບันทึก
                </button>

                <a href="{{ route('students.index') }}"
                    class="px-6 py-3 rounded-xl bg-gray-500 text-white font-semibold shadow hover:bg-gray-600 transition">
                    ❌ ยกเลิก
                </a>
            </div>
        </form>

    </div>

</body>
</html>
