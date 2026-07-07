<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = Teacher::with(['user'])->withCount('students');

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
            'email' => 'required|string|email|max:255|unique:users,email',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $password = Str::random(10);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
            'role' => 'ustadz',
        ]);

        Teacher::create([
            'name' => $validated['name'],
            'whatsapp' => $validated['whatsapp'],
            'user_id' => $user->id,
            'gender' => 'male', // default gender
        ]);

        return redirect()->route('teachers.index')->with('success', "Data ustadz berhasil ditambahkan. Email: {$user->email}, Password: {$password}");
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load('user');
        return view('teachers.form', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $teacher->user_id,
            'whatsapp' => 'nullable|string|max:20',
        ]);

        if ($teacher->user) {
            $teacher->user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);
        }

        $teacher->update([
            'name' => $validated['name'],
            'whatsapp' => $validated['whatsapp'],
        ]);

        return redirect()->route('teachers.index')->with('success', 'Data ustadz berhasil diperbarui.');
    }

    public function destroy(Teacher $teacher)
    {
        $user = $teacher->user;
        $teacher->delete();
        if ($user) {
            $user->delete();
        }
        return redirect()->route('teachers.index')->with('success', 'Data ustadz berhasil dihapus.');
    }
}
