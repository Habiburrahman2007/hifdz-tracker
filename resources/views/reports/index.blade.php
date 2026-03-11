@extends('layouts.app')
@section('title', 'Laporan Bulanan')
@section('page-title', 'Laporan Bulanan')
@section('page-subtitle', 'Analisis progress hafalan per santri')

@section('content')
<div class="section-header fade-in">
    <div class="section-header-icon" style="background: linear-gradient(135deg, #7c3aed, #db2777);">📊</div>
    <div class="section-header-text">
        <h1>Laporan Bulanan</h1>
        <p>Progress dan statistik hafalan santri</p>
    </div>
    @if(isset($student))
    <div class="section-header-actions">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Print / Export PDF</button>
    </div>
    @endif
</div>

<!-- Student & Month Selector -->
<div class="card mb-24 fade-in fade-in-1">
    <div class="card-body" style="padding:16px 22px;">
        <form method="GET" action="{{ route('reports.index') }}" class="filter-bar">
            <select name="student_id" class="form-control" style="max-width:260px" required>
                <option value="">Pilih Santri...</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" {{ $selectedStudentId == $s->id ? 'selected' : '' }}>{{ $s->name }} (Kelas {{ $s->grade }})</option>
                @endforeach
            </select>
            <select name="month" class="form-control" style="max-width:160px">
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromDate(null, $m)->locale('id')->isoFormat('MMMM') }}
                    </option>
                @endforeach
            </select>
            <select name="year" class="form-control" style="max-width:120px">
                @foreach(range(date('Y') - 2, date('Y') + 1) as $y)
                    <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">🔍 Tampilkan</button>
        </form>
    </div>
</div>

@if(!isset($student))
<div class="card fade-in">
    <div class="empty-state">
        <div class="empty-state-icon">📊</div>
        <p>Pilih santri dan bulan untuk melihat laporan.</p>
    </div>
</div>
@else

<!-- Student Profile + Progress -->
<div class="grid grid-3 mb-24">
    <!-- Profile Card -->
    <div class="card fade-in fade-in-1">
        <div class="card-body text-center">
            <div class="avatar {{ $student->gender === 'male' ? 'avatar-male' : 'avatar-female' }}" style="width:72px;height:72px;font-size:28px;border-radius:18px;margin:0 auto 12px;">
                {{ substr($student->name, 0, 1) }}
            </div>
            <div class="fw-700" style="font-size:17px;margin-bottom:4px">{{ $student->name }}</div>
            <div class="text-muted text-sm mb-8">{{ $student->halaqah_class }}</div>
            <div class="flex gap-8 mb-16" style="justify-content:center;flex-wrap:wrap">
                <span class="badge badge-primary">Kelas {{ $student->grade }}</span>
                <span class="badge badge-secondary">{{ $student->teacher?->name ?? 'Belum ada' }}</span>
                <span class="badge badge-warning">Ranking #{{ $rank }} / {{ $totalStudents }}</span>
            </div>
            <div class="mb-8">
                <div class="text-sm text-muted mb-4">Progress Menuju 30 Juz</div>
                <div class="progress" style="height:12px;margin-bottom:6px">
                    <div class="progress-bar" style="width:{{ $progressPct }}%"></div>
                </div>
                <div class="fw-700" style="font-size:20px;color:var(--primary-dark)">{{ $progressPct }}%</div>
            </div>
        </div>
    </div>

    <!-- All-time progress stats -->
    <div class="card fade-in fade-in-2">
        <div class="card-header"><h3>📈 Progress Keseluruhan</h3></div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div style="background:#f0fdf4;padding:14px;border-radius:12px;text-align:center;">
                    <div class="fw-800" style="font-size:24px;color:#059669">{{ floor($totalJuz) }}</div>
                    <div class="text-xs text-muted">Juz</div>
                </div>
                <div style="background:#eff6ff;padding:14px;border-radius:12px;text-align:center;">
                    <div class="fw-800" style="font-size:24px;color:#1d4ed8">{{ $totalPages }}</div>
                    <div class="text-xs text-muted">Halaman</div>
                </div>
                <div style="background:#fef3c7;padding:14px;border-radius:12px;text-align:center;">
                    <div class="fw-800" style="font-size:24px;color:#d97706">{{ $totalLines }}</div>
                    <div class="text-xs text-muted">Total Baris</div>
                </div>
                <div style="background:#fdf2f8;padding:14px;border-radius:12px;text-align:center;">
                    <div class="fw-800" style="font-size:24px;color:#be185d">{{ $memorizedSurahs->count() }}</div>
                    <div class="text-xs text-muted">Surah Dihafal</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Juz memorized dots -->
    <div class="card fade-in fade-in-3">
        <div class="card-header"><h3>🔢 Juz yang Dihafal</h3></div>
        <div class="card-body">
            <div style="display:grid;grid-template-columns:repeat(6,1fr);gap:6px;">
                @for($j = 1; $j <= 30; $j++)
                    @php $done = $memorizedJuz->contains($j); @endphp
                    <div style="width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:700;background:{{ $done ? 'var(--gradient)' : '#f1f5f9' }};color:{{ $done ? '#fff' : '#94a3b8' }};">
                        {{ $j }}
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Monthly Stats Comparison -->
<div class="grid grid-3 mb-24">
    @foreach([
        ['month' => $selectedMonth, 'year' => $selectedYear, 'stats' => $monthStats, 'label' => 'Bulan Ini', 'color' => 'var(--gradient)', 'current' => true],
        ['month' => $prevMonth1->month, 'year' => $prevMonth1->year, 'stats' => $prevStats1, 'label' => $prevMonth1->locale('id')->isoFormat('MMMM YYYY'), 'color' => 'linear-gradient(135deg,#0284c7,#6366f1)', 'current' => false],
        ['month' => $prevMonth2->month, 'year' => $prevMonth2->year, 'stats' => $prevStats2, 'label' => $prevMonth2->locale('id')->isoFormat('MMMM YYYY'), 'color' => 'linear-gradient(135deg,#d97706,#f59e0b)', 'current' => false],
    ] as $comp)
    <div class="card fade-in {{ $comp['current'] ? 'fade-in-1' : ($loop->index == 1 ? 'fade-in-2' : 'fade-in-3') }}" style="{{ $comp['current'] ? 'border: 2px solid var(--primary);' : '' }}">
        <div class="card-header" style="background:{{ $comp['color'] }};padding:14px 18px;border-bottom:none;">
            <h3 style="color:#fff;font-size:13px;">{{ $comp['current'] ? '⭐ ' : '' }}{{ $comp['label'] }}</h3>
        </div>
        <div class="card-body" style="padding:16px;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:12px;">
                @foreach([['Sabaq Baris', $comp['stats']['sabaq_lines']], ['Sabqi Baris', $comp['stats']['sabqi_lines']], ['Manzil Baris', $comp['stats']['manzil_lines']], ['Total Juz', $comp['stats']['total_juz']]] as [$lbl, $val])
                <div style="background:#f8fafc;padding:10px;border-radius:8px;text-align:center;">
                    <div class="fw-800" style="font-size:16px;color:#1e293b">{{ $val }}</div>
                    <div class="text-xs text-muted">{{ $lbl }}</div>
                </div>
                @endforeach
            </div>
            <div class="flex gap-8" style="justify-content:center;">
                <span class="badge badge-success">✅ {{ $comp['stats']['present_days'] }} Hadir</span>
                <span class="badge badge-danger">❌ {{ $comp['stats']['absent_days'] }} Absen</span>
            </div>
            <div class="text-center mt-16">
                <div class="text-xs text-muted">Rata-rata Nilai Kelancaran</div>
                @php $avgF = $comp['stats']['avg_fluency']; @endphp
                <div class="fw-800" style="font-size:22px;color:{{ $avgF >= 90 ? '#059669' : ($avgF >= 75 ? '#d97706' : '#dc2626') }}">{{ $avgF }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Daily Logs Table -->
<div class="card mb-24 fade-in fade-in-3">
    <div class="card-header">
        <div style="font-size:20px;">📅</div>
        <h3>Log Harian — {{ \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, 1)->locale('id')->isoFormat('MMMM YYYY') }}</h3>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Tgl</th>
                    <th>Hari</th>
                    <th>Kehadiran</th>
                    <th>Sabaq</th>
                    <th>Sabqi</th>
                    <th>Manzil</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dailyLogs as $day => $log)
                @php
                    try {
                        $date = \Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, $day);
                        $isValid = true;
                    } catch (\Exception $e) {
                        $isValid = false;
                    }
                @endphp
                @if($isValid)
                <tr style="{{ $log['attendance'] === 'alpha' ? 'background:#fff5f5' : '' }}">
                    <td class="fw-700">{{ $day }}</td>
                    <td class="text-sm text-muted">{{ $date->locale('id')->isoFormat('ddd') }}</td>
                    <td>
                        @if($log['attendance'])
                            @php $attColors = ['present'=>'success','excused'=>'warning','late'=>'info','alpha'=>'danger','sick'=>'secondary']; $attLabels = ['present'=>'Hadir','excused'=>'Izin','late'=>'Telat','alpha'=>'Alpha','sick'=>'Sakit']; @endphp
                            <span class="badge badge-{{ $attColors[$log['attendance']] ?? 'secondary' }}">{{ $attLabels[$log['attendance']] ?? '-' }}</span>
                        @else
                            <span class="text-muted text-xs">—</span>
                        @endif
                    </td>
                    <td>
                        @if($log['sabaq'])
                            <div class="text-sm fw-700" style="color:#1d4ed8">{{ $log['sabaq']->surah_name }}</div>
                            <div class="text-xs text-muted">{{ $log['sabaq']->line_count }} baris</div>
                        @else <span class="text-muted">—</span> @endif
                    </td>
                    <td>
                        @if($log['sabqi'])
                            <div class="text-sm fw-700" style="color:#065f46">{{ $log['sabqi']->surah_name }}</div>
                            <div class="text-xs text-muted">{{ $log['sabqi']->line_count }} baris</div>
                        @else <span class="text-muted">—</span> @endif
                    </td>
                    <td>
                        @if($log['manzil'])
                            <div class="text-sm fw-700" style="color:#92400e">{{ $log['manzil']->surah_name }}</div>
                            <div class="text-xs text-muted">{{ $log['manzil']->line_count }} baris</div>
                        @else <span class="text-muted">—</span> @endif
                    </td>
                    <td>
                        @if($log['fluency'] !== null)
                            @php $f = $log['fluency']; @endphp
                            <span class="fw-700" style="color:{{ $f >= 90 ? '#059669' : ($f >= 75 ? '#d97706' : '#dc2626') }}">{{ $f }}</span>
                        @else <span class="text-muted">—</span> @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Memorized Surahs -->
<div class="card fade-in fade-in-4">
    <div class="card-header">
        <div style="font-size:20px;">📖</div>
        <h3>Daftar Surah yang Dihafal</h3>
        <span class="badge badge-success">{{ $memorizedSurahs->count() }} Surah</span>
    </div>
    <div class="card-body">
        <div style="display:flex;flex-wrap:wrap;gap:8px;">
            @foreach($memorizedSurahs as $surah)
            <span class="badge badge-primary" style="font-size:12px;padding:6px 12px;">
                {{ $surah->surah_number }}. {{ $surah->surah_name }}
                <span class="text-xs" style="opacity:0.7">(Juz {{ $surah->juz }})</span>
            </span>
            @endforeach
        </div>
    </div>
</div>

@endif
@endsection

@push('styles')
<style>
@media print {
    .sidebar, .topbar, .filter-bar, .section-header-actions, form { display: none !important; }
    .main { margin-left: 0 !important; }
    .page-content { padding: 0 !important; }
    .card { break-inside: avoid; box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
}
</style>
@endpush
