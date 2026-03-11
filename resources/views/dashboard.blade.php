@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data dan analisis progress hafalan')

@section('content')
<!-- Summary Cards -->
<div class="grid grid-4 mb-24">
    <div class="stat-card fade-in fade-in-1" style="background: linear-gradient(135deg, #4f46e5, #7c3aed);">
        <span class="stat-card-icon">👨‍🎓</span>
        <div class="stat-card-value">{{ number_format($totalStudents) }}</div>
        <div class="stat-card-label">Total Santri</div>
    </div>
    <div class="stat-card fade-in fade-in-2" style="background: linear-gradient(135deg, #059669, #0d9488);">
        <span class="stat-card-icon">👨‍🏫</span>
        <div class="stat-card-value">{{ number_format($totalTeachers) }}</div>
        <div class="stat-card-label">Total Ustadz/ah</div>
    </div>
    <div class="stat-card fade-in fade-in-3" style="background: linear-gradient(135deg, #d97706, #f59e0b);">
        <span class="stat-card-icon">🕌</span>
        <div class="stat-card-value">{{ number_format($totalHalaqah) }}</div>
        <div class="stat-card-label">Kelas Halaqah</div>
    </div>
    <div class="stat-card fade-in fade-in-4" style="background: linear-gradient(135deg, #dc2626, #e11d48);">
        <span class="stat-card-icon">📜</span>
        <div class="stat-card-value">{{ number_format($totalLines) }}</div>
        <div class="stat-card-label">Total Baris Hafalan</div>
    </div>
</div>

<!-- Rankings Row -->
<div class="grid grid-2 mb-24">
    <!-- Top 10 -->
    <div class="card fade-in fade-in-2">
        <div class="card-header">
            <div style="font-size:20px;">🏆</div>
            <h3>Top 10 Hafiz Terbaik</h3>
            <a href="{{ route('reports.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Pencapaian</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topStudents as $i => $student)
                    <tr>
                        <td>
                            <div class="rank-badge {{ $i === 0 ? 'rank-1' : ($i === 1 ? 'rank-2' : ($i === 2 ? 'rank-3' : 'rank-n')) }}">
                                {{ $i === 0 ? '🥇' : ($i === 1 ? '🥈' : ($i === 2 ? '🥉' : $i+1)) }}
                            </div>
                        </td>
                        <td>
                            <div class="flex items-center gap-8">
                                <div class="avatar avatar-male">{{ substr($student['name'], 0, 1) }}</div>
                                <div>
                                    <div class="fw-700" style="font-size:13px">{{ $student['name'] }}</div>
                                    <div class="text-muted text-xs">{{ $student['halaqah_class'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-primary">Kelas {{ $student['grade'] }}</span></td>
                        <td>
                            <div class="fw-700" style="color:var(--primary-dark)">{{ floor($student['total_juz']) }} Juz</div>
                            <div class="text-xs text-muted">{{ $student['total_pages'] }} Halaman</div>
                        </td>
                        <td style="min-width:100px">
                            <div class="progress mb-4">
                                <div class="progress-bar" style="width:{{ $student['progress_pct'] }}%"></div>
                            </div>
                            <div class="text-xs text-muted">{{ $student['progress_pct'] }}%</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bottom 10 -->
    <div class="card fade-in fade-in-3">
        <div class="card-header">
            <div style="font-size:20px;">📢</div>
            <h3>Santri Perlu Perhatian</h3>
            <span class="badge badge-warning">10 Terendah</span>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Pencapaian</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bottomStudents as $i => $student)
                    <tr>
                        <td><div class="rank-badge rank-n" style="background:#fee2e2;color:#dc2626;">{{ $totalStudents - $i }}</div></td>
                        <td>
                            <div class="flex items-center gap-8">
                                <div class="avatar avatar-male" style="background:#fee2e2;color:#dc2626;">{{ substr($student['name'], 0, 1) }}</div>
                                <div>
                                    <div class="fw-700" style="font-size:13px">{{ $student['name'] }}</div>
                                    <div class="text-muted text-xs">{{ $student['halaqah_class'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-warning">Kelas {{ $student['grade'] }}</span></td>
                        <td>
                            <div class="fw-700" style="color:#dc2626;">{{ floor($student['total_juz']) }} Juz</div>
                            <div class="text-xs text-muted">{{ $student['total_pages'] }} Halaman</div>
                        </td>
                        <td style="min-width:100px">
                            <div class="progress mb-4">
                                <div class="progress-bar" style="width:{{ $student['progress_pct'] }}%; background: linear-gradient(135deg, #ef4444, #f97316);"></div>
                            </div>
                            <div class="text-xs text-muted">{{ $student['progress_pct'] }}%</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Charts Row 1 -->
<div class="grid grid-2 mb-24">
    <!-- Daily Lines Chart -->
    <div class="card fade-in fade-in-3">
        <div class="card-header">
            <div style="font-size:20px;">📈</div>
            <h3>Statistik Baris Harian</h3>
            <span class="badge badge-info">{{ \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1)->locale('id')->isoFormat('MMMM YYYY') }}</span>
        </div>
        <div class="card-body">
            <div class="chart-container" style="height:280px;">
                <canvas id="dailyLinesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Fluency Distribution -->
    <div class="card fade-in fade-in-4">
        <div class="card-header">
            <div style="font-size:20px;">🎯</div>
            <h3>Distribusi Nilai Kelancaran</h3>
        </div>
        <div class="card-body">
            <div class="chart-container" style="height:280px;">
                <canvas id="fluencyChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 2 -->
<div class="grid grid-3 mb-24">
    <!-- Grade Achievement -->
    <div class="card fade-in fade-in-4">
        <div class="card-header">
            <div style="font-size:20px;">🏫</div>
            <h3>Pencapaian per Kelas</h3>
        </div>
        <div class="card-body">
            <div class="chart-container" style="height:240px;">
                <canvas id="gradeChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Target Achievement Pie -->
    <div class="card fade-in fade-in-5">
        <div class="card-header">
            <div style="font-size:20px;">🎪</div>
            <h3>Pencapaian Target</h3>
        </div>
        <div class="card-body">
            <div class="chart-container" style="height:240px;">
                <canvas id="targetChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Progress Distribution -->
    <div class="card fade-in fade-in-6">
        <div class="card-header">
            <div style="font-size:20px;">📊</div>
            <h3>Distribusi Progress</h3>
        </div>
        <div class="card-body">
            <div class="chart-container" style="height:240px;">
                <canvas id="progressDistChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const chartDefaults = {
    font: { family: 'Inter', size: 12 },
    color: '#64748b',
};
Chart.defaults.font.family = 'Inter';
Chart.defaults.color = '#64748b';

// Daily Lines Chart
const days = Array.from({length: 31}, (_, i) => i + 1);
const sabaqCurrent = @json(array_values($dailyCurrentMonth['sabaq'] ?? []));
const sabqiCurrent = @json(array_values($dailyCurrentMonth['sabqi'] ?? []));
const manzilCurrent = @json(array_values($dailyCurrentMonth['manzil'] ?? []));
const sabaqLast = @json(array_values($dailyLastMonth['sabaq'] ?? []));

new Chart(document.getElementById('dailyLinesChart'), {
    type: 'bar',
    data: {
        labels: days,
        datasets: [
            { label: 'Sabaq (Bulan Ini)', data: sabaqCurrent, backgroundColor: 'rgba(79,70,229,0.8)', borderRadius: 4 },
            { label: 'Sabqi (Bulan Ini)', data: sabqiCurrent, backgroundColor: 'rgba(16,185,129,0.8)', borderRadius: 4 },
            { label: 'Manzil (Bulan Ini)', data: manzilCurrent, backgroundColor: 'rgba(245,158,11,0.8)', borderRadius: 4 },
            { label: 'Sabaq (Bulan Lalu)', data: sabaqLast, backgroundColor: 'rgba(79,70,229,0.25)', borderRadius: 4 },
        ]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } },
        scales: {
            x: { grid: { display: false }, ticks: { font: { size: 10 } } },
            y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 } } }
        }
    }
});

// Fluency Distribution
const fluencyLabels = @json($fluencyDistribution->keys());
const fluencyData = @json($fluencyDistribution->values());
new Chart(document.getElementById('fluencyChart'), {
    type: 'doughnut',
    data: {
        labels: fluencyLabels,
        datasets: [{
            data: fluencyData,
            backgroundColor: ['#059669','#0d9488','#d97706','#dc2626','#7c3aed'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } },
        },
        cutout: '65%'
    }
});

// Grade Achievement
const gradeStats = @json($gradeStats);
const gradeLabels = Object.keys(gradeStats).map(g => `Kelas ${g}`);
const gradeJuz = Object.values(gradeStats).map(s => s.avg_juz);
new Chart(document.getElementById('gradeChart'), {
    type: 'bar',
    data: {
        labels: gradeLabels,
        datasets: [{
            label: 'Rata-rata Juz',
            data: gradeJuz,
            backgroundColor: ['#4f46e5','#059669','#d97706','#dc2626','#7c3aed','#0284c7'],
            borderRadius: 8,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false } },
            y: { grid: { color: '#f1f5f9' }, title: { display: true, text: 'Rata-rata Juz', font: { size: 11 } } }
        }
    }
});

// Target Achievement Pie
const targetLabels = @json(array_keys($targetAchievement));
const targetData = @json(array_values($targetAchievement));
new Chart(document.getElementById('targetChart'), {
    type: 'pie',
    data: {
        labels: targetLabels,
        datasets: [{
            data: targetData,
            backgroundColor: ['#059669','#0284c7','#d97706','#dc2626'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } }
    }
});

// Progress Distribution
const distLabels = @json(array_keys($progressDist));
const distData = @json(array_values($progressDist));
new Chart(document.getElementById('progressDistChart'), {
    type: 'bar',
    data: {
        labels: distLabels,
        datasets: [{
            label: 'Jumlah Santri',
            data: distData,
            backgroundColor: ['#fee2e2','#fed7aa','#fef3c7','#d1fae5','#059669'],
            borderColor: ['#dc2626','#ea580c','#d97706','#059669','#065f46'],
            borderWidth: 2,
            borderRadius: 8,
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false } },
            y: { grid: { color: '#f1f5f9' }, ticks: { stepSize: 1 } }
        }
    }
});
</script>
@endpush
