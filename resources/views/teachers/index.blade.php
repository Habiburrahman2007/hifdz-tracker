@extends('layouts.app')
@section('title', 'Data Ustadz')
@section('page-title', 'Data Ustadz')
@section('page-subtitle', 'Manajemen data pengajar tahfidz')

@section('content')
<div class="section-header fade-in">
    <div class="section-header-icon" style="background: linear-gradient(135deg, #d97706, #f59e0b);">👨‍🏫</div>
    <div class="section-header-text">
        <h1>Data Ustadz</h1>
        <p>Total {{ $teachers->total() }} pengajar terdaftar</p>
    </div>
    @if(auth()->check() && auth()->user()->isAdmin())
    <div class="section-header-actions">
        <a href="{{ route('teachers.create') }}" wire:navigate class="btn btn-primary">+ Tambah Ustadz</a>
    </div>
    @endif
</div>

<div class="card fade-in fade-in-1">
    <div class="card-body" style="padding: 16px 22px;">
        <form method="GET" action="{{ route('teachers.index') }}" class="filter-bar">
            <input type="text" name="search" placeholder="🔍 Cari nama..." class="form-control" value="{{ request('search') }}" style="max-width:260px">
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="{{ route('teachers.index') }}" wire:navigate class="btn btn-secondary">Reset</a>
        </form>
    </div>
</div>

<div style="height:16px"></div>

<div class="grid grid-3 fade-in fade-in-2">
    @forelse($teachers as $teacher)
    <div class="card" style="overflow:visible;">
        <div class="card-body">
            <div class="flex items-center gap-12 mb-16">
                <div>
                    <div class="fw-700" style="font-size:15px">{{ $teacher->name }}</div>
                </div>
            </div>

            <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:16px;">
                @if($teacher->whatsapp)
                <div class="flex items-center gap-8">
                    <span style="font-size:14px">📱</span>
                    <span class="text-sm">{{ $teacher->whatsapp }}</span>
                </div>
                @endif
                @if($teacher->user && $teacher->user->email)
                <div class="flex items-center gap-8">
                    <span style="font-size:14px">✉️</span>
                    <span class="text-sm" style="word-break: break-all;">{{ $teacher->user->email }}</span>
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
                @if(auth()->check() && auth()->user()->isAdmin())
                <a href="{{ route('teachers.edit', $teacher) }}" wire:navigate class="btn btn-secondary btn-sm">✏️ Edit</a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="delete-form" onsubmit="confirmDelete(event, 'Apakah Anda yakin ingin menghapus data Ustadz {{ $teacher->name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="card" style="grid-column: 1/-1;">
        <div class="empty-state">
            <div class="empty-state-icon">👨‍🏫</div>
            <p>Belum ada data ustadz.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
