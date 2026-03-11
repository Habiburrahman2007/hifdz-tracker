<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Setoran;
use App\Helpers\QuranHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::with('teacher')->orderBy('name')->get();
        $selectedStudentId = $request->get('student_id', $students->first()?->id);
        $selectedMonth = (int)$request->get('month', Carbon::now()->month);
        $selectedYear = (int)$request->get('year', Carbon::now()->year);

        if (!$selectedStudentId) {
            return view('reports.index', compact('students', 'selectedStudentId', 'selectedMonth', 'selectedYear'));
        }

        $student = Student::with('teacher')->findOrFail($selectedStudentId);

        // All setorans for this student this month
        $monthSetorans = Setoran::where('student_id', $selectedStudentId)
            ->whereYear('date', $selectedYear)
            ->whereMonth('date', $selectedMonth)
            ->orderBy('date')
            ->get();

        // Monthly stats
        $monthStats = $this->getMonthStats($monthSetorans);

        // Previous 2 months comparison
        $prevMonth1 = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->subMonth();
        $prevMonth2 = Carbon::createFromDate($selectedYear, $selectedMonth, 1)->subMonths(2);

        $prevMonthSetorans1 = Setoran::where('student_id', $selectedStudentId)
            ->whereYear('date', $prevMonth1->year)
            ->whereMonth('date', $prevMonth1->month)
            ->get();

        $prevMonthSetorans2 = Setoran::where('student_id', $selectedStudentId)
            ->whereYear('date', $prevMonth2->year)
            ->whereMonth('date', $prevMonth2->month)
            ->get();

        $prevStats1 = $this->getMonthStats($prevMonthSetorans1);
        $prevStats2 = $this->getMonthStats($prevMonthSetorans2);

        // Daily logs (day 1-31)
        $dailyLogs = [];
        for ($d = 1; $d <= 31; $d++) {
            $daySetorans = $monthSetorans->filter(fn($s) => $s->date->day === $d);
            $dailyLogs[$d] = [
                'sabaq' => $daySetorans->where('type', 'sabaq')->first(),
                'sabqi' => $daySetorans->where('type', 'sabqi')->first(),
                'manzil' => $daySetorans->where('type', 'manzil')->first(),
                'attendance' => $daySetorans->first()?->attendance,
                'fluency' => $daySetorans->where('type', 'sabaq')->first()?->fluency_score,
            ];
        }

        // All time sabaq setorans (for progress)
        $allSabaqSetorans = Setoran::where('student_id', $selectedStudentId)
            ->where('type', 'sabaq')
            ->orderBy('date')
            ->get();

        $totalLines = $allSabaqSetorans->sum('line_count');
        $totalPages = round($totalLines / 15, 1);
        $totalJuz = round($totalPages / 20, 2);
        $progressPct = min(100, round(($totalJuz / 30) * 100, 1));

        // Surahs memorized (distinct surahs from sabaq)
        $memorizedSurahs = $allSabaqSetorans->unique('surah_number')->sortBy('surah_number')->values();
        $memorizedJuz = $allSabaqSetorans->unique('juz')->sortBy('juz')->pluck('juz')->values();

        // Ranking
        $rankings = Student::get()->map(function ($s) {
            return [
                'id' => $s->id,
                'lines' => Setoran::where('student_id', $s->id)->where('type', 'sabaq')->sum('line_count'),
            ];
        })->sortByDesc('lines')->values();

        $rank = $rankings->search(fn($r) => $r['id'] === $student->id) + 1;
        $totalStudents = $rankings->count();

        return view('reports.index', compact(
            'students', 'student',
            'selectedStudentId', 'selectedMonth', 'selectedYear',
            'monthStats', 'prevStats1', 'prevStats2',
            'prevMonth1', 'prevMonth2',
            'dailyLogs',
            'totalLines', 'totalPages', 'totalJuz', 'progressPct',
            'memorizedSurahs', 'memorizedJuz',
            'rank', 'totalStudents'
        ));
    }

    private function getMonthStats($setorans): array
    {
        $sabaq = $setorans->where('type', 'sabaq');
        $sabqi = $setorans->where('type', 'sabqi');
        $manzil = $setorans->where('type', 'manzil');
        $present = $setorans->filter(fn($s) => in_array($s->attendance, ['present', 'late']));
        $absent = $setorans->filter(fn($s) => in_array($s->attendance, ['alpha', 'sick', 'excused']));

        $totalLines = $sabaq->sum('line_count');
        $totalPages = round($totalLines / 15, 1);
        $totalJuz = round($totalPages / 20, 2);

        $uniqueSurahs = $sabaq->unique('surah_number')->count();
        $avgFluency = $sabaq->where('fluency_score', '>', 0)->avg('fluency_score');

        return [
            'total_lines' => $totalLines,
            'total_pages' => $totalPages,
            'total_juz' => $totalJuz,
            'total_surahs' => $uniqueSurahs,
            'sabaq_lines' => $sabaq->sum('line_count'),
            'sabqi_lines' => $sabqi->sum('line_count'),
            'manzil_lines' => $manzil->sum('line_count'),
            'present_days' => $present->count(),
            'absent_days' => $absent->count(),
            'avg_fluency' => round($avgFluency ?? 0, 1),
        ];
    }
}
