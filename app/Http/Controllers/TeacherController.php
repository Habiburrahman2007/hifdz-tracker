<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::withCount('students');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $teachers = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.form', ['teacher' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'whatsapp' => 'nullable|string|max:20',
            'alumnus_of' => 'nullable|string|max:255',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Data ustadz/ustadzah berhasil ditambahkan.');
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.form', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'whatsapp' => 'nullable|string|max:20',
            'alumnus_of' => 'nullable|string|max:255',
        ]);

        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'Data ustadz/ustadzah berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Data ustadz/ustadzah berhasil dihapus.');
    }
}
