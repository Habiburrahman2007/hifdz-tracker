@extends('layouts.app')
@section('title', ($student ? 'Edit' : 'Tambah') . ' Santri')
@section('page-title', $student ? 'Edit Data Santri' : 'Tambah Santri Baru')
@section('page-subtitle', $student ? 'Perbarui informasi santri' : 'Isi data santri baru')

@section('content')
<div style="max-width: 720px;">
    <div class="card fade-in">
        <div class="card-header">
            <div style="font-size:20px;">👨‍🎓</div>
            <h3>{{ $student ? 'Edit Data: ' . $student->name : 'Form Santri Baru' }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ $student ? route('students.update', $student) : route('students.store') }}">
                @csrf
                @if($student) @method('PUT') @endif

                <div class="grid grid-2">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $student?->name) }}" required placeholder="Nama lengkap santri">
                        @error('name')<p style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin *</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="male" {{ old('gender', $student?->gender) === 'male' ? 'selected' : '' }}>♂ Laki-laki</option>
                            <option value="female" {{ old('gender', $student?->gender) === 'female' ? 'selected' : '' }}>♀ Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kelas *</label>
                        <select name="grade" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            @foreach(range(7, 12) as $g)
                                <option value="{{ $g }}" {{ old('grade', $student?->grade) == $g ? 'selected' : '' }}>Kelas {{ $g }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kelas Halaqah *</label>
                        <input type="text" name="halaqah_class" class="form-control" value="{{ old('halaqah_class', $student?->halaqah_class) }}" required placeholder="Contoh: Halaqah Al-Fatih">
                    </div>

                    <div class="form-group">
                        <label class="form-label">NISN</label>
                        <input type="text" name="nisn" class="form-control" value="{{ old('nisn', $student?->nisn) }}" placeholder="Nomor Induk Siswa Nasional">
                        @error('nisn')<p style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Ustadz/Ustadzah Pembimbing</label>
                        <select name="teacher_id" class="form-control">
                            <option value="">Pilih Ustadz/ah</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id', $student?->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Orang Tua/Wali</label>
                        <input type="text" name="parent_name" class="form-control" value="{{ old('parent_name', $student?->parent_name) }}" placeholder="Nama orang tua atau wali">
                    </div>

                    <div class="form-group">
                        <label class="form-label">WhatsApp Orang Tua</label>
                        <input type="text" name="parent_whatsapp" class="form-control" value="{{ old('parent_whatsapp', $student?->parent_whatsapp) }}" placeholder="Contoh: 08123456789">
                    </div>
                </div>

                <div class="flex gap-12 mt-20">
                    <button type="submit" class="btn btn-primary">
                        {{ $student ? '💾 Simpan Perubahan' : '➕ Tambah Santri' }}
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">← Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
