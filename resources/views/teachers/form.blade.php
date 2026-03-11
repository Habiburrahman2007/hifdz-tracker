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
                    <label class="form-label">Jenis Kelamin *</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="male" {{ old('gender', $teacher?->gender) === 'male' ? 'selected' : '' }}>♂ Laki-laki</option>
                        <option value="female" {{ old('gender', $teacher?->gender) === 'female' ? 'selected' : '' }}>♀ Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $teacher?->whatsapp) }}" placeholder="08123456789">
                </div>

                <div class="form-group">
                    <label class="form-label">Alumnus Pondok/Pesantren</label>
                    <input type="text" name="alumnus_of" class="form-control" value="{{ old('alumnus_of', $teacher?->alumnus_of) }}" placeholder="Contoh: Pesantren Al-Quran Bandung">
                </div>

                <div class="flex gap-12 mt-20">
                    <button type="submit" class="btn btn-primary">
                        {{ $teacher ? '💾 Simpan' : '➕ Tambah' }}
                    </button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">← Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
