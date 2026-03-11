<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('teacher');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('nisn', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('grade')) {
            $query->where('grade', $request->grade);
        }

        if ($request->filled('halaqah')) {
            $query->where('halaqah_class', $request->halaqah);
        }

        $sortBy = $request->get('sort', 'name');
        $sortDir = $request->get('dir', 'asc');
        $query->orderBy($sortBy, $sortDir);

        $students = $query->paginate(25)->withQueryString();
        $teachers = Teacher::orderBy('name')->get();
        $halaqahClasses = Student::distinct()->pluck('halaqah_class')->sort()->values();

        return view('students.index', compact('students', 'teachers', 'halaqahClasses'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('students.form', ['student' => null, 'teachers' => $teachers]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'grade' => 'required|integer|between:7,12',
            'halaqah_class' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:20|unique:students,nisn',
            'teacher_id' => 'nullable|exists:teachers,id',
            'parent_name' => 'nullable|string|max:255',
            'parent_whatsapp' => 'nullable|string|max:20',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Data santri berhasil ditambahkan.');
    }

    public function edit(Student $student)
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('students.form', compact('student', 'teachers'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'grade' => 'required|integer|between:7,12',
            'halaqah_class' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:20|unique:students,nisn,' . $student->id,
            'teacher_id' => 'nullable|exists:teachers,id',
            'parent_name' => 'nullable|string|max:255',
            'parent_whatsapp' => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Data santri berhasil dihapus.');
    }
}
