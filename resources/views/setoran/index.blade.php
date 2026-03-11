@extends('layouts.app')
@section('title', 'Setoran Hafalan')
@section('page-title', 'Setoran Hafalan')
@section('page-subtitle', 'Riwayat setoran Sabaq, Sabqi, dan Manzil')

@section('content')
<div class="section-header fade-in">
    <div class="section-header-icon" style="background: linear-gradient(135deg, #dc2626, #e11d48);">📝</div>
    <div class="section-header-text">
        <h1>Setoran Hafalan</h1>
        <p>Input dan kelola setoran harian santri</p>
    </div>
    <div class="section-header-actions">
        <a href="{{ route('setoran.create') }}" class="btn btn-primary">+ Input Setoran</a>
    </div>
</div>

<!-- Filters -->
<div class="card mb-20 fade-in fade-in-1">
    <div class="card-body" style="padding:16px 22px;">
        <form method="GET" action="{{ route('setoran.index') }}" class="filter-bar">
            <select name="student_id" class="form-control" style="max-width:220px">
                <option value="">Semua Santri</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
            <select name="type" class="form-control" style="max-width:150px">
                <option value="">Semua Jenis</option>
                <option value="sabaq" {{ request('type') === 'sabaq' ? 'selected' : '' }}>📗 Sabaq</option>
                <option value="sabqi" {{ request('type') === 'sabqi' ? 'selected' : '' }}>📘 Sabqi</option>
                <option value="manzil" {{ request('type') === 'manzil' ? 'selected' : '' }}>📙 Manzil</option>
            </select>
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" style="max-width:160px">
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" style="max-width:160px">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('setoran.index') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>
</div>

<div class="card fade-in fade-in-2">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th data-sort>Tanggal</th>
                    <th data-sort>Santri</th>
                    <th data-sort>Jenis</th>
                    <th data-sort>Surah</th>
                    <th data-sort>Juz</th>
                    <th data-sort>Ayat</th>
                    <th data-sort>Baris</th>
                    <th data-sort>Kehadiran</th>
                    <th data-sort>Nilai</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($setorans as $s)
                <tr>
                    <td data-val="{{ $s->date->format('Y-m-d') }}">
                        <div class="fw-700" style="font-size:13px">{{ $s->date->format('d M Y') }}</div>
                        <div class="text-xs text-muted">{{ $s->date->locale('id')->dayName }}</div>
                    </td>
                    <td>
                        <div class="flex items-center gap-8">
                            <div class="avatar {{ $s->student->gender === 'male' ? 'avatar-male' : 'avatar-female' }}">{{ substr($s->student->name, 0, 1) }}</div>
                            <div>
                                <div class="fw-700" style="font-size:13px">{{ $s->student->name }}</div>
                                <div class="text-xs text-muted">Kelas {{ $s->student->grade }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @php $typeColors = ['sabaq'=>'background:#dbeafe;color:#1d4ed8','sabqi'=>'background:#d1fae5;color:#065f46','manzil'=>'background:#fef3c7;color:#92400e']; @endphp
                        <span class="badge" style="{{ $typeColors[$s->type] ?? '' }}">
                            {{ $s->type === 'sabaq' ? '📗' : ($s->type === 'sabqi' ? '📘' : '📙') }} {{ ucfirst($s->type) }}
                        </span>
                    </td>
                    <td>
                        <div class="fw-700" style="font-size:13px">{{ $s->surah_name }}</div>
                        <div class="text-xs text-muted">QS {{ $s->surah_number }}</div>
                    </td>
                    <td><span class="badge badge-primary">Juz {{ $s->juz }}</span></td>
                    <td class="text-sm">{{ $s->start_ayat }} – {{ $s->end_ayat }}</td>
                    <td><span class="badge badge-secondary">{{ $s->line_count }} baris</span></td>
                    <td>
                        @php $attColors = ['present'=>'success','excused'=>'warning','late'=>'info','alpha'=>'danger','sick'=>'secondary']; @endphp
                        <span class="badge badge-{{ $attColors[$s->attendance] ?? 'secondary' }}">{{ $s->attendance_label }}</span>
                    </td>
                    <td>
                        @php
                            $score = $s->fluency_score;
                            $scoreColor = $score >= 90 ? '#059669' : ($score >= 75 ? '#d97706' : '#dc2626');
                        @endphp
                        <span class="fw-700" style="color:{{ $scoreColor }}; font-size:15px">{{ $score }}</span>
                    </td>
                    <td class="text-muted text-sm">{{ $s->notes ? Str::limit($s->notes, 30) : '-' }}</td>
                    <td>
                        <div class="flex gap-8">
                            <a href="{{ route('setoran.edit', $s) }}" class="btn btn-secondary btn-sm">✏️</a>
                            <form action="{{ route('setoran.destroy', $s) }}" method="POST" class="delete-form" onsubmit="return confirm('Hapus setoran ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11">
                        <div class="empty-state">
                            <div class="empty-state-icon">📝</div>
                            <p>Belum ada data setoran.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($setorans->hasPages())
        <div class="pagination">
            @foreach($setorans->links()->elements[0] as $page => $url)
                @if($page == $setorans->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection
