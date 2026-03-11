@extends('layouts.app')
@section('title', 'Data Ustadz/ah')
@section('page-title', 'Data Ustadz/Ustadzah')
@section('page-subtitle', 'Manajemen data pengajar tahfidz')

@section('content')
<div class="section-header fade-in">
    <div class="section-header-icon" style="background: linear-gradient(135deg, #d97706, #f59e0b);">👨‍🏫</div>
    <div class="section-header-text">
        <h1>Data Ustadz/Ustadzah</h1>
        <p>Total {{ $teachers->total() }} pengajar terdaftar</p>
    </div>
    <div class="section-header-actions">
        <a href="{{ route('teachers.create') }}" class="btn btn-primary">+ Tambah Ustadz/ah</a>
    </div>
</div>

<div class="card fade-in fade-in-1">
    <div class="card-body" style="padding: 16px 22px;">
        <form method="GET" action="{{ route('teachers.index') }}" class="filter-bar">
            <input type="text" name="search" placeholder="🔍 Cari nama..." class="form-control" value="{{ request('search') }}" style="max-width:260px">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>
</div>

<div style="height:16px"></div>

<div class="grid grid-3 fade-in fade-in-2">
    @forelse($teachers as $teacher)
    <div class="card" style="overflow:visible;">
        <div class="card-body">
            <div class="flex items-center gap-12 mb-16">
                <div class="avatar {{ $teacher->gender === 'male' ? 'avatar-male' : 'avatar-female' }}" style="width:56px;height:56px;font-size:22px;border-radius:14px;">
                    {{ substr($teacher->name, 0, 1) }}
                </div>
                <div>
                    <div class="fw-700" style="font-size:15px">{{ $teacher->name }}</div>
                    <span class="badge {{ $teacher->gender === 'male' ? 'badge-info' : '' }}" style="{{ $teacher->gender === 'female' ? 'background:#fce7f3;color:#be185d' : '' }}">
                        {{ $teacher->gender === 'male' ? '♂ Laki-laki' : '♀ Perempuan' }}
                    </span>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:16px;">
                <div class="flex items-center gap-8">
                    <span style="font-size:14px">🔥</span>
                    <span class="text-sm">Alumnus: <strong>{{ $teacher->alumnus_of ?? 'Tidak diketahui' }}</strong></span>
                </div>
                @if($teacher->whatsapp)
                <div class="flex items-center gap-8">
                    <span style="font-size:14px">📱</span>
                    <span class="text-sm">{{ $teacher->whatsapp }}</span>
                </div>
                @endif
                <div class="flex items-center gap-8">
                    <span style="font-size:14px">👨‍🎓</span>
                    <span class="text-sm">{{ $teacher->students_count }} Santri Bimbingan</span>
                </div>
            </div>

            <div class="flex gap-8">
                @if($teacher->whatsapp)
                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $teacher->whatsapp) }}" target="_blank" class="btn btn-success btn-sm flex-1 text-center" style="justify-content:center">💬 WA</a>
                @endif
                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-secondary btn-sm">✏️ Edit</a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="delete-form" onsubmit="return confirm('Hapus data {{ $teacher->name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="card" style="grid-column: 1/-1;">
        <div class="empty-state">
            <div class="empty-state-icon">👨‍🏫</div>
            <p>Belum ada data ustadz/ah.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
