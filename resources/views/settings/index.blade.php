@extends('layouts.app')
@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Sistem')
@section('page-subtitle', 'Konfigurasi tampilan dan informasi lembaga')

@section('content')
<div style="max-width:700px;">
    <div class="section-header fade-in">
        <div class="section-header-icon" style="background: linear-gradient(135deg, #475569, #64748b);">⚙️</div>
        <div class="section-header-text">
            <h1>Pengaturan</h1>
            <p>Sesuaikan tampilan dan informasi pesantren</p>
        </div>
    </div>

    <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- Institution Info -->
        <div class="card mb-20 fade-in fade-in-1">
            <div class="card-header">
                <div style="font-size:20px;">🏛️</div>
                <h3>Informasi Lembaga</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Nama Lembaga / Pesantren</label>
                    <input type="text" name="institution_name" class="form-control" value="{{ old('institution_name', $institutionName) }}" required placeholder="Pesantren Darul Ilmi">
                </div>

                <div class="form-group">
                    <label class="form-label">Logo Lembaga</label>
                    <div style="display:flex;gap:12px;align-items:center;margin-bottom:10px;">
                        @if($logo)
                            <img src="{{ Storage::url($logo) }}" alt="Logo" style="width:56px;height:56px;object-fit:cover;border-radius:12px;border:2px solid #e2e8f0;">
                        @else
                            <div style="width:56px;height:56px;background:#f1f5f9;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;">📖</div>
                        @endif
                        <div>
                            <input type="file" name="logo" accept="image/*" class="form-control" style="max-width:280px">
                            <p class="text-xs text-muted mt-16">Format: JPG, PNG, SVG. Max 2MB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Theme Engine -->
        <div class="card mb-24 fade-in fade-in-2">
            <div class="card-header">
                <div style="font-size:20px;">🎨</div>
                <h3>Tema Warna Aplikasi</h3>
                <span class="badge badge-primary">6 Pilihan</span>
            </div>
            <div class="card-body">
                <div class="grid grid-3" style="gap:12px;">
                    @php
                        $themes = [
                            ['id' => 'emerald', 'name' => 'Emerald', 'desc' => 'Hijau segar & modern', 'gradient' => 'linear-gradient(135deg,#059669,#0d9488)', 'emoji' => '💚'],
                            ['id' => 'ocean', 'name' => 'Ocean', 'desc' => 'Biru laut yang tenang', 'gradient' => 'linear-gradient(135deg,#0284c7,#6366f1)', 'emoji' => '🌊'],
                            ['id' => 'sunset', 'name' => 'Sunset', 'desc' => 'Merah hangat & energik', 'gradient' => 'linear-gradient(135deg,#dc2626,#f97316)', 'emoji' => '🌅'],
                            ['id' => 'purple', 'name' => 'Purple', 'desc' => 'Ungu elegan & kreatif', 'gradient' => 'linear-gradient(135deg,#7c3aed,#db2777)', 'emoji' => '💜'],
                            ['id' => 'rose', 'name' => 'Rose', 'desc' => 'Merah muda premium', 'gradient' => 'linear-gradient(135deg,#e11d48,#a855f7)', 'emoji' => '🌹'],
                            ['id' => 'amber', 'name' => 'Amber', 'desc' => 'Kuning emas & natural', 'gradient' => 'linear-gradient(135deg,#d97706,#16a34a)', 'emoji' => '🌾'],
                        ];
                    @endphp
                    @foreach($themes as $t)
                    <label for="theme-{{ $t['id'] }}" style="cursor:pointer;">
                        <input type="radio" name="theme" id="theme-{{ $t['id'] }}" value="{{ $t['id'] }}" {{ $theme === $t['id'] ? 'checked' : '' }} style="display:none;" class="theme-radio">
                        <div class="theme-card {{ $theme === $t['id'] ? 'theme-active' : '' }}" style="border:2px solid #e2e8f0;border-radius:14px;overflow:hidden;transition:all 0.2s;position:relative;">
                            @if($theme === $t['id'])
                                <div style="position:absolute;top:8px;right:8px;width:22px;height:22px;background:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;z-index:1;">✓</div>
                            @endif
                            <div style="height:56px;background:{{ $t['gradient'] }};display:flex;align-items:center;justify-content:center;font-size:24px;">{{ $t['emoji'] }}</div>
                            <div style="padding:10px 12px;">
                                <div class="fw-700" style="font-size:13px">{{ $t['name'] }}</div>
                                <div class="text-xs text-muted">{{ $t['desc'] }}</div>
                            </div>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="font-size:15px;padding:12px 28px;">
            💾 Simpan Pengaturan
        </button>
    </form>
</div>
@endsection

@push('styles')
<style>
.theme-radio:checked + .theme-card {
    border-color: var(--primary) !important;
    box-shadow: 0 0 0 3px var(--primary-light);
}
.theme-card:hover {
    border-color: var(--primary) !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
}
</style>
@endpush
