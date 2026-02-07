<!DOCTYPE html>
<html lang="lo">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ລາຍລະອຽດນັກຮຽນ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 to-pink-100 min-h-screen p-6">

    <div class="max-w-2xl mx-auto bg-white/80 backdrop-blur-xl shadow-xl rounded-3xl p-8 border border-white/40">

        <h1 class="text-center text-3xl font-bold text-blue-700 mb-8">
            ລາຍລະອຽດນັກຮຽນ
        </h1>

        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-xl">
                <span class="font-semibold text-gray-600">ລະຫັດ:</span>
                <span class="ml-2 text-gray-800">{{ $student->id }}</span>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl">
                <span class="font-semibold text-gray-600">ຊື່:</span>
                <span class="ml-2 text-gray-800">{{ $student->first_name }}</span>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl">
                <span class="font-semibold text-gray-600">ນາມສະກຸນ:</span>
                <span class="ml-2 text-gray-800">{{ $student->last_name }}</span>
            </div>

            <div class="bg-gray-50 p-4 rounded-xl">
                <span class="font-semibold text-gray-600">ເພດ:</span>
                <span class="ml-2 text-gray-800">
                    @if($student->gender == 'male')
                        ຊາຍ
                    @elseif($student->gender == 'female')
                        ຍິງ
                    @else
                        ອື່ນໆ
                    @endif
                </span>
            </div>
        </div>

        <div class="mt-8 flex gap-3">
            <a href="{{ route('students.index') }}"
                class="px-5 py-3 rounded-xl bg-gray-600 text-white font-semibold shadow hover:bg-gray-700">
                ⬅ ກັບຄືນ
            </a>

            <a href="{{ route('students.edit', $student->id) }}"
                class="px-5 py-3 rounded-xl bg-yellow-500 text-white font-semibold shadow hover:bg-yellow-600">
                ✏ ແກ້ໄຂ
            </a>
        </div>

    </div>

</body>
</html>