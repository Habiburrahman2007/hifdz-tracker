@extends('layouts.app')
@section('title', 'Data Santri')
@section('page-title', 'Data Santri')
@section('page-subtitle', 'Manajemen data seluruh santri tahfidz')

@section('content')
<div class="section-header fade-in">
    <div class="section-header-icon" style="background: linear-gradient(135deg, #059669, #0d9488);">👨‍🎓</div>
    <div class="section-header-text">
        <h1>Data Santri</h1>
        <p>Total {{ $students->total() }} santri terdaftar</p>
    </div>
    <div class="section-header-actions">
        <a href="{{ route('students.create') }}" class="btn btn-primary">+ Tambah Santri</a>
    </div>
</div>

<!-- Filter Bar -->
<div class="card mb-20 fade-in fade-in-1">
    <div class="card-body" style="padding: 16px 22px;">
        <form method="GET" action="{{ route('students.index') }}" class="filter-bar">
            <input type="text" name="search" placeholder="🔍 Cari nama / NISN..." class="form-control" value="{{ request('search') }}" style="max-width:260px">
            <select name="grade" class="form-control" style="max-width:160px">
                <option value="">Semua Kelas</option>
                @foreach(range(7, 12) as $g)
                    <option value="{{ $g }}" {{ request('grade') == $g ? 'selected' : '' }}>Kelas {{ $g }}</option>
                @endforeach
            </select>
            <select name="halaqah" class="form-control" style="max-width:200px">
                <option value="">Semua Halaqah</option>
                @foreach($halaqahClasses as $h)
                    <option value="{{ $h }}" {{ request('halaqah') == $h ? 'selected' : '' }}>{{ $h }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>
</div>

<div class="card fade-in fade-in-2">
    <div class="table-wrapper">
        <table id="students-table">
            <thead>
                <tr>
                    <th data-sort>No</th>
                    <th data-sort>Nama Santri</th>
                    <th data-sort>L/P</th>
                    <th data-sort>Kelas</th>
                    <th data-sort>Halaqah</th>
                    <th data-sort>NISN</th>
                    <th data-sort>Ustadz/ah</th>
                    <th data-sort>Orang Tua</th>
                    <th data-sort>WhatsApp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $i => $student)
                <tr>
                    <td>{{ $students->firstItem() + $i }}</td>
                    <td>
                        <div class="flex items-center gap-8">
                            <div class="avatar {{ $student->gender === 'male' ? 'avatar-male' : 'avatar-female' }}">
                                {{ substr($student->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="fw-700">{{ $student->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $student->gender === 'male' ? 'badge-info' : 'badge-danger' }}" style="{{ $student->gender === 'female' ? 'background:#fce7f3;color:#be185d' : '' }}">
                            {{ $student->gender === 'male' ? '♂ L' : '♀ P' }}
                        </span>
                    </td>
                    <td><span class="badge badge-primary">Kelas {{ $student->grade }}</span></td>
                    <td><span class="text-sm">{{ $student->halaqah_class }}</span></td>
                    <td><span class="text-muted text-sm">{{ $student->nisn ?? '-' }}</span></td>
                    <td><span class="text-sm">{{ $student->teacher?->name ?? '-' }}</span></td>
                    <td><span class="text-sm">{{ $student->parent_name ?? '-' }}</span></td>
                    <td>
                        @if($student->parent_whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $student->parent_whatsapp) }}" target="_blank" class="btn btn-success btn-sm">
                                💬 WA
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex gap-8">
                            <a href="{{ route('setoran.create', ['student_id' => $student->id]) }}" class="btn btn-primary btn-sm">📝</a>
                            <a href="{{ route('reports.index', ['student_id' => $student->id]) }}" class="btn btn-secondary btn-sm">📊</a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-secondary btn-sm">✏️</a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="delete-form" onsubmit="return confirm('Hapus data santri {{ $student->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10">
                        <div class="empty-state">
                            <div class="empty-state-icon">👨‍🎓</div>
                            <p>Belum ada data santri. <a href="{{ route('students.create') }}" style="color:var(--primary)">Tambah santri pertama</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($students->hasPages())
        <div class="pagination">
            @foreach($students->links()->elements[0] as $page => $url)
                @if($page == $students->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection
