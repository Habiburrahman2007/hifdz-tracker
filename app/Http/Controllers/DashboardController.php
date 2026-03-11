<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Setoran;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $institutionName = Setting::get('institution_name', 'Pesantren Darul Ilmi');
        $logo = Setting::get('logo', '');
        $theme = Setting::get('theme', 'emerald');

        // Summary cards
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalHalaqah = Student::distinct('halaqah_class')->count('halaqah_class');
        $totalLines = Setoran::where('type', 'sabaq')->sum('line_count');

        // Top 10 rankings
        $topStudents = $this->getStudentRankings()->take(10)->values();
        $bottomStudents = $this->getStudentRankings()->sortBy('total_lines')->take(10)->values();

        // Charts data
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $lastMonthDate = Carbon::now()->subMonth();
        $lastMonth = $lastMonthDate->month;
        $lastMonthYear = $lastMonthDate->year;

        // Daily lines current month vs last month
        $dailyCurrentMonth = $this->getDailyLineStats($currentYear, $currentMonth);
        $dailyLastMonth = $this->getDailyLineStats($lastMonthYear, $lastMonth);

        // Fluency score distribution
        $fluencyDistribution = Setoran::select(
            DB::raw("CASE
                WHEN fluency_score >= 95 THEN '95-100'
                WHEN fluency_score >= 85 THEN '85-94'
                WHEN fluency_score >= 75 THEN '75-84'
                WHEN fluency_score >= 65 THEN '65-74'
                ELSE '<65'
            END as score_range"),
            DB::raw('COUNT(*) as total_count')
        )
        ->where('type', 'sabaq')
        ->where('attendance', 'present')
        ->groupBy('score_range')
        ->orderBy('score_range', 'desc')
        ->pluck('total_count', 'score_range');

        // Grade achievement
        $gradeStats = Student::select('grade')
            ->with(['setorans' => fn($q) => $q->where('type', 'sabaq')])
            ->get()
            ->groupBy('grade')
            ->map(function ($gradeStudents) {
                $totalLines = $gradeStudents->sum(fn($s) => $s->setorans->sum('line_count'));
                $count = $gradeStudents->count();
                $avgLines = $count > 0 ? $totalLines / $count : 0;
                return [
                    'count' => $count,
                    'avg_lines' => round($avgLines),
                    'avg_juz' => round($avgLines / 300, 1), // 300 lines per juz
                ];
            })
            ->sortKeys();

        // Progress distribution
        $rankings = $this->getStudentRankings();
        $progressDist = [
            '0-1 Juz' => $rankings->filter(fn($s) => $s['total_juz'] < 1)->count(),
            '1-5 Juz' => $rankings->filter(fn($s) => $s['total_juz'] >= 1 && $s['total_juz'] < 5)->count(),
            '5-10 Juz' => $rankings->filter(fn($s) => $s['total_juz'] >= 5 && $s['total_juz'] < 10)->count(),
            '10-20 Juz' => $rankings->filter(fn($s) => $s['total_juz'] >= 10 && $s['total_juz'] < 20)->count(),
            '20-30 Juz' => $rankings->filter(fn($s) => $s['total_juz'] >= 20)->count(),
        ];

        // Target achievement
        $targetAchievement = [
            'Tercapai (≥30J)' => $rankings->filter(fn($s) => $s['total_juz'] >= 30)->count(),
            'Hampir (20-30J)' => $rankings->filter(fn($s) => $s['total_juz'] >= 20 && $s['total_juz'] < 30)->count(),
            'Sedang (10-20J)' => $rankings->filter(fn($s) => $s['total_juz'] >= 10 && $s['total_juz'] < 20)->count(),
            'Awal (<10J)' => $rankings->filter(fn($s) => $s['total_juz'] < 10)->count(),
        ];

        return view('dashboard', compact(
            'institutionName', 'logo', 'theme',
            'totalStudents', 'totalTeachers', 'totalHalaqah', 'totalLines',
            'topStudents', 'bottomStudents',
            'dailyCurrentMonth', 'dailyLastMonth',
            'fluencyDistribution', 'gradeStats',
            'progressDist', 'targetAchievement',
            'currentMonth', 'currentYear', 'lastMonth'
        ));
    }

    private function getStudentRankings()
    {
        return Student::with('teacher')
            ->get()
            ->map(function ($student) {
                $totalLines = $student->setorans()->where('type', 'sabaq')->sum('line_count');
                $totalPages = round($totalLines / 15, 1);
                $totalJuz = round($totalPages / 20, 2);
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'grade' => $student->grade,
                    'halaqah_class' => $student->halaqah_class,
                    'teacher' => $student->teacher?->name ?? '-',
                    'total_lines' => $totalLines,
                    'total_pages' => $totalPages,
                    'total_juz' => $totalJuz,
                    'progress_pct' => min(100, round(($totalJuz / 30) * 100, 1)),
                ];
            })
            ->sortByDesc('total_lines')
            ->values();
    }

    private function getDailyLineStats(int $year, int $month): array
    {
        $days = range(1, 31);
        $result = [];

        $data = Setoran::select(
            DB::raw('DAY(date) as day'),
            'type',
            DB::raw('SUM(line_count) as total')
        )
        ->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->groupBy('day', 'type')
        ->get();

        foreach ($days as $day) {
            $result['sabaq'][$day] = 0;
            $result['sabqi'][$day] = 0;
            $result['manzil'][$day] = 0;
        }

        foreach ($data as $row) {
            $result[$row->type][$row->day] = (int)$row->total;
        }

        return $result;
    }
}
