@extends('layouts.app')
@section('title', (isset($setoran) ? 'Edit' : 'Input') . ' Setoran')
@section('page-title', isset($setoran) ? 'Edit Setoran' : 'Input Setoran Baru')
@section('page-subtitle', 'Form input setoran Sabaq, Sabqi, dan Manzil')

@section('content')
<div style="max-width:760px;">
    <div class="card fade-in">
        <div class="card-header">
            <div style="font-size:20px;">📝</div>
            <h3>{{ isset($setoran) ? 'Edit Setoran' : 'Form Input Setoran Hafalan' }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ isset($setoran) ? route('setoran.update', $setoran) : route('setoran.store') }}" id="setoran-form">
                @csrf
                @if(isset($setoran)) @method('PUT') @endif

                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Santri *</label>
                        <select name="student_id" class="form-control" required id="student-select">
                            <option value="">Pilih Santri</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    data-teacher="{{ $student->teacher_id }}"
                                    {{ old('student_id', $setoran?->student_id ?? $selectedStudentId) == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} (Kelas {{ $student->grade }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ustadz/ah *</label>
                        <select name="teacher_id" class="form-control" id="teacher-select">
                            <option value="">Pilih Ustadz/ah</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id', $setoran?->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal *</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date', $setoran?->date?->format('Y-m-d') ?? date('Y-m-d')) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Setoran *</label>
                        <select name="type" class="form-control" required>
                            <option value="">Pilih Jenis</option>
                            <option value="sabaq" {{ old('type', $setoran?->type) === 'sabaq' ? 'selected' : '' }}>📗 Sabaq (Hafalan Baru)</option>
                            <option value="sabqi" {{ old('type', $setoran?->type) === 'sabqi' ? 'selected' : '' }}>📘 Sabqi (Muraja'ah Dekat)</option>
                            <option value="manzil" {{ old('type', $setoran?->type) === 'manzil' ? 'selected' : '' }}>📙 Manzil (Muraja'ah Jauh)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Surah *</label>
                        <select name="surah_number" class="form-control" required id="surah-select">
                            <option value="">Pilih Surah</option>
                            @foreach($surahs as $surah)
                                <option value="{{ $surah['number'] }}"
                                    data-juz="{{ $surah['juz'] }}"
                                    data-name="{{ $surah['name'] }}"
                                    data-ayat="{{ $surah['ayat_count'] }}"
                                    {{ old('surah_number', $setoran?->surah_number) == $surah['number'] ? 'selected' : '' }}>
                                    {{ $surah['number'] }}. {{ $surah['name'] }} (Juz {{ $surah['juz'] }}, {{ $surah['ayat_count'] }} ayat)
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="surah_name" id="surah-name" value="{{ old('surah_name', $setoran?->surah_name) }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Juz *</label>
                        <select name="juz" class="form-control" required id="juz-select">
                            @for($j = 1; $j <= 30; $j++)
                                <option value="{{ $j }}" {{ old('juz', $setoran?->juz) == $j ? 'selected' : '' }}>Juz {{ $j }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ayat Mulai *</label>
                        <input type="number" name="start_ayat" class="form-control" min="1" value="{{ old('start_ayat', $setoran?->start_ayat ?? 1) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ayat Selesai *</label>
                        <input type="number" name="end_ayat" class="form-control" min="1" value="{{ old('end_ayat', $setoran?->end_ayat ?? 1) }}" required id="end-ayat">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jumlah Baris *</label>
                        <input type="number" name="line_count" class="form-control" min="0" value="{{ old('line_count', $setoran?->line_count ?? 0) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kehadiran *</label>
                        <select name="attendance" class="form-control" required>
                            <option value="present" {{ old('attendance', $setoran?->attendance ?? 'present') === 'present' ? 'selected' : '' }}>✅ Hadir</option>
                            <option value="late" {{ old('attendance', $setoran?->attendance) === 'late' ? 'selected' : '' }}>🕐 Terlambat</option>
                            <option value="excused" {{ old('attendance', $setoran?->attendance) === 'excused' ? 'selected' : '' }}>📋 Izin</option>
                            <option value="sick" {{ old('attendance', $setoran?->attendance) === 'sick' ? 'selected' : '' }}>🤒 Sakit</option>
                            <option value="alpha" {{ old('attendance', $setoran?->attendance) === 'alpha' ? 'selected' : '' }}>❌ Alpha</option>
                        </select>
                    </div>
                </div>

                <!-- Fluency Score Widget -->
                <div class="form-group">
                    <label class="form-label">Nilai Kelancaran (Fluency Score)</label>
                    <div class="score-widget">
                        <button type="button" class="score-btn score-btn-minus" onclick="adjustScore(-5)">−5</button>
                        <div class="score-display" id="score-display">{{ old('fluency_score', $setoran?->fluency_score ?? 100) }}</div>
                        <button type="button" class="score-btn score-btn-plus" onclick="adjustScore(5)">+5</button>
                        <input type="hidden" name="fluency_score" id="fluency-score" value="{{ old('fluency_score', $setoran?->fluency_score ?? 100) }}">
                        <span class="text-muted text-sm">Default: 100, kurangi 5 per kesalahan</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea name="notes" class="form-control" placeholder="Catatan tambahan (opsional)...">{{ old('notes', $setoran?->notes) }}</textarea>
                </div>

                <div class="flex gap-12 mt-20">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($setoran) ? '💾 Simpan Perubahan' : '📝 Simpan Setoran' }}
                    </button>
                    <a href="{{ route('setoran.index') }}" class="btn btn-secondary">← Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fluency score adjuster
function adjustScore(delta) {
    const input = document.getElementById('fluency-score');
    const display = document.getElementById('score-display');
    let val = parseInt(input.value) + delta;
    val = Math.max(0, Math.min(100, val));
    input.value = val;
    display.textContent = val;
    display.style.color = val >= 90 ? '#059669' : val >= 75 ? '#d97706' : '#dc2626';
}

// Surah select auto-fill juz and ayat max
document.getElementById('surah-select').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    if (opt.value) {
        document.getElementById('juz-select').value = opt.dataset.juz;
        document.getElementById('surah-name').value = opt.dataset.name;
        document.getElementById('end-ayat').max = opt.dataset.ayat;
    }
});

// Student select auto-fill teacher
document.getElementById('student-select').addEventListener('change', function() {
    const opt = this.options[this.selectedIndex];
    const teacherId = opt.dataset.teacher;
    if (teacherId) {
        document.getElementById('teacher-select').value = teacherId;
    }
});

// Initialize score color
adjustScore(0);
</script>
@endpush
