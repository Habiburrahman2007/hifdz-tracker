<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use App\Models\Student;
use App\Models\Teacher;
use App\Helpers\QuranHelper;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SetoranController extends Controller
{
    public function index(Request $request)
    {
        $query = Setoran::with(['student', 'teacher']);

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        $setorans = $query->orderBy('date', 'desc')->orderBy('id', 'desc')->paginate(30)->withQueryString();
        $students = Student::orderBy('name')->get();

        return view('setoran.index', compact('setorans', 'students'));
    }

    public function create(Request $request)
    {
        $students = Student::with('teacher')->orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $surahs = QuranHelper::getSurahOptions();
        $selectedStudentId = $request->get('student_id');

        return view('setoran.form', compact('students', 'teachers', 'surahs', 'selectedStudentId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'date' => 'required|date',
            'type' => 'required|in:sabaq,sabqi,manzil',
            'juz' => 'required|integer|between:1,30',
            'surah_name' => 'required|string',
            'surah_number' => 'required|integer|between:1,114',
            'start_ayat' => 'required|integer|min:1',
            'end_ayat' => 'required|integer|min:1',
            'line_count' => 'required|integer|min:0',
            'notes' => 'nullable|string',
            'attendance' => 'required|in:present,excused,late,alpha,sick',
            'fluency_score' => 'required|integer|between:0,100',
        ]);

        Setoran::create($validated);

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil dicatat.');
    }

    public function edit(Setoran $setoran)
    {
        $students = Student::with('teacher')->orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $surahs = QuranHelper::getSurahOptions();

        return view('setoran.form', compact('setoran', 'students', 'teachers', 'surahs'));
    }

    public function update(Request $request, Setoran $setoran)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'date' => 'required|date',
            'type' => 'required|in:sabaq,sabqi,manzil',
            'juz' => 'required|integer|between:1,30',
            'surah_name' => 'required|string',
            'surah_number' => 'required|integer|between:1,114',
            'start_ayat' => 'required|integer|min:1',
            'end_ayat' => 'required|integer|min:1',
            'line_count' => 'required|integer|min:0',
            'notes' => 'nullable|string',
            'attendance' => 'required|in:present,excused,late,alpha,sick',
            'fluency_score' => 'required|integer|between:0,100',
        ]);

        $setoran->update($validated);

        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil diperbarui.');
    }

    public function destroy(Setoran $setoran)
    {
        $setoran->delete();
        return redirect()->route('setoran.index')->with('success', 'Setoran berhasil dihapus.');
    }
}
