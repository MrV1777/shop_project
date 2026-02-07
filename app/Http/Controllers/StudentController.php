<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;

        if ($keyword) {
            $students = Student::where('first_name', 'like', "%{$keyword}%")
                ->orWhere('last_name', 'like', "%{$keyword}%")
                ->orWhere('gender', 'like', "%{$keyword}%")
                ->get();

            if ($students->count() == 0) {
                return view('students.list_student', compact('students'))
                    ->with('warning', 'ບໍ່ພົບข้อมูลที่ค้นหา "' . $keyword . '"');
            }
        } else {
            $students = Student::all();
        }

        return view('students.list_student', compact('students'));
    }

    public function create()
    {
        return view('students.add_student');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
        ]);

        Student::create($request->only(['first_name', 'last_name', 'gender']));

        return redirect()->route('students.index')
            ->with('success', 'Created successfully!');
    }

    public function show(Student $student)
    {
        return view('students.list_student', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit_student', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
        ]);

        $student->update($request->only(['first_name', 'last_name', 'gender']));

        return redirect()->route('students.index')
            ->with('success', 'Updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Deleted successfully!');
    }

    public function clearAll()
    {
        DB::table('students')->update([
            'first_name' => null,
            'last_name'  => null,
            'gender'     => null,
        ]);

        return redirect()->route('students.index')->with('success', 'All student data cleared!');
    }
}
