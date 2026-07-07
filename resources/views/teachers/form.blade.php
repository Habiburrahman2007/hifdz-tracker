@extends('layouts.app')
@section('title', ($teacher ? 'Edit' : 'Tambah') . ' Ustadz/ah')
@section('page-title', $teacher ? 'Edit Data Ustadz/ah' : 'Tambah Ustadz/ah Baru')

@section('content')
<div style="max-width: 560px;">
    <div class="card fade-in">
        <div class="card-header">
            <div style="font-size:20px;">👨‍🏫</div>
            <h3>{{ $teacher ? 'Edit: ' . $teacher->name : 'Form Ustadz/ah Baru' }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ $teacher ? route('teachers.update', $teacher) : route('teachers.store') }}">
                @csrf
                @if($teacher) @method('PUT') @endif

                <div class="form-group">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $teacher?->name) }}" required placeholder="Contoh: Ustadz Ahmad Fauzi">
                    @error('name')<p style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $teacher?->user?->email) }}" required placeholder="Contoh: ustadz@example.com">
                    @error('email')<p style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $teacher?->whatsapp) }}" placeholder="08123456789">
                    @error('whatsapp')<p style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</p>@enderror
                </div>

                <div class="flex gap-12 mt-20">
                    <button type="submit" class="btn btn-primary">
                        {{ $teacher ? '💾 Simpan' : '➕ Tambah' }}
                    </button>
                    <a href="{{ route('teachers.index') }}" wire:navigate class="btn btn-secondary">← Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
