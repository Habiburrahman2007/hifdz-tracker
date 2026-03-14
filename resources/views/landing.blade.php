<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hifdz Tracker - Manajemen Hafalan Santri</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        islamic: {
                            green: '#047857', // Emerald 700
                            light: '#ecfdf5', // Emerald 50
                            gold: '#d97706',  // Amber 600
                            dark: '#064e3b',  // Emerald 900
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .fade-up { animation: fadeUp 0.8s ease-out forwards; opacity: 0; transform: translateY(20px); }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        @keyframes fadeUp { to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans selection:bg-islamic-green selection:text-white">

    <!-- Header / Navbar -->
    <header class="fixed w-full bg-white/90 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/logo.png') }}" class="w-10 h-10 object-contain" alt="Hifdz Tracker Logo">
                    <span class="font-bold text-xl text-gray-900 tracking-tight">Hifdz Tracker</span>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="#fitur" class="text-gray-600 hover:text-islamic-green font-medium transition">Fitur</a>
                    <a href="#cara-kerja" class="text-gray-600 hover:text-islamic-green font-medium transition">Cara Kerja</a>
                    <a href="#testimoni" class="text-gray-600 hover:text-islamic-green font-medium transition">Testimoni</a>
                </nav>
                <div class="flex items-center gap-4">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-islamic-green text-white font-semibold rounded-full hover:bg-islamic-dark transition-colors shadow-lg shadow-islamic-green/30">
                        Masuk Dashboard
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- 1. Hero Section -->
    <section class="pt-32 pb-20 lg:pt-48 lg:pb-32 bg-islamic-light overflow-hidden relative">
        <div class="absolute inset-0 z-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23047857\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 text-center lg:text-left fade-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-islamic-green/20 text-sm font-medium text-islamic-green mb-6">
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-islamic-gold opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-islamic-gold"></span>
                        </span>
                        Sistem Manajemen Tahfidz Digital
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-gray-900 leading-tight mb-6">
                        Kelola Setoran Hafalan Santri dengan <span class="text-islamic-green">Lebih Mudah</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto lg:mx-0">
                        Tidak perlu lagi pencatatan manual yang rumit. Dengan Hifdz Tracker, ustadz dan ustadzah dapat memantau progres hafalan santri secara real-time dalam satu sistem yang rapi dan mudah digunakan.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-3.5 bg-islamic-green text-white font-semibold rounded-full hover:bg-islamic-dark transition-transform hover:-translate-y-1 shadow-xl shadow-islamic-green/30 text-center">
                            Coba Demo
                        </a>
                        <a href="#" class="w-full sm:w-auto px-8 py-3.5 bg-white border border-gray-300 text-gray-700 font-semibold rounded-full hover:bg-gray-50 transition-colors text-center">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2 fade-up delay-200">
                    <div class="relative rounded-2xl bg-white shadow-2xl p-2 border border-white/50 transform rotate-1 hover:rotate-0 transition-transform duration-500">
                        <div class="absolute -inset-1 bg-gradient-to-r from-islamic-green to-islamic-gold rounded-2xl blur opacity-20"></div>
                        <img src="{{ asset('img/lp.jpg') }}" alt="Dashboard Preview / Al Quran" class="rounded-xl relative z-10 w-full h-[400px] object-cover shadow-sm">
                        <!-- Dashboard UI Mock overlay -->
                        <div class="absolute bottom-4 -left-6 bg-white p-4 rounded-xl shadow-xl z-20 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-islamic-green">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Setoran Berhasil</p>
                                <p class="text-xs text-gray-500">Juz 30, Surat As-Syams</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Problem Section -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Tantangan dalam Mengelola Hafalan Santri</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Sistem konvensional seringkali membatasi potensi pengawasan secara maksimal.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="flex items-start gap-4 p-6 bg-red-50 rounded-2xl">
                    <div class="mt-1 bg-red-100 p-2 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Pencatatan setoran masih manual di buku</h3>
                        <p class="text-gray-600 text-sm">Rentan terselip, rusak, atau sulit direkapitulasi secara berkala.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-6 bg-red-50 rounded-2xl">
                    <div class="mt-1 bg-red-100 p-2 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Sulit memantau perkembangan hafalan setiap santri</h3>
                        <p class="text-gray-600 text-sm">Tidak ada visualisasi grafik progres yang memadai untuk melihat capaian per minggu atau bulan.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-6 bg-red-50 rounded-2xl">
                    <div class="mt-1 bg-red-100 p-2 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Data hafalan mudah hilang atau tidak terarsip dengan baik</h3>
                        <p class="text-gray-600 text-sm">Resiko kehilangan histori sangat besar ketika buku prestasi rusak atau hilang.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 p-6 bg-red-50 rounded-2xl">
                    <div class="mt-1 bg-red-100 p-2 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-2">Orang tua sulit mengetahui progres hafalan anak</h3>
                        <p class="text-gray-600 text-sm">Laporan biasanya hanya turun pada waktu pembagian raport saja.</p>
                    </div>
                </div>
            </div>

            <div class="mt-16 text-center max-w-3xl mx-auto bg-islamic-green/10 rounded-2xl p-8 border border-islamic-green/20">
                <h3 class="text-2xl font-bold text-islamic-dark mb-4">Hifdz Tracker Mengatasi Semua Masalah Ini</h3>
                <p class="text-gray-700">Digitalisasi pencatatan hafalan membantu Anda fokus pada hal yang paling penting: membimbing santri menghafal kalam ilahi.</p>
            </div>
        </div>
    </section>

    <!-- 3. Features Section -->
    <section id="fitur" class="py-24 bg-gray-50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-islamic-gold font-bold tracking-wider uppercase text-sm">Solusi Digital</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Fitur Utama Hifdz Tracker</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-islamic-green/30 transition-all duration-300">
                    <div class="w-12 h-12 bg-islamic-light text-islamic-green rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Manajemen Data Santri</h3>
                    <p class="text-gray-600">Kelola data santri dengan mudah dalam satu dashboard terpusat tanpa ribet.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-islamic-green/30 transition-all duration-300">
                    <div class="w-12 h-12 bg-islamic-light text-islamic-green rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pencatatan Setoran Hafalan</h3>
                    <p class="text-gray-600">Catat setoran hafalan santri secara cepat dan terstruktur setiap hari beserta kualitas bacaannya.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-islamic-green/30 transition-all duration-300">
                    <div class="w-12 h-12 bg-islamic-light text-islamic-green rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Monitoring Progres Hafalan</h3>
                    <p class="text-gray-600">Lihat perkembangan hafalan santri secara visual dan terorganisir melalu metrik intuitif.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-islamic-green/30 transition-all duration-300">
                    <div class="w-12 h-12 bg-islamic-light text-islamic-green rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Riwayat Hafalan Lengkap</h3>
                    <p class="text-gray-600">Semua catatan setoran tersimpan rapi selamanya dan dapat diakses kapan saja.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl hover:border-islamic-green/30 transition-all duration-300">
                    <div class="w-12 h-12 bg-islamic-light text-islamic-green rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Dashboard Ustadz/Ustadzah</h3>
                    <p class="text-gray-600">Interface sederhana untuk memudahkan guru memonitor hafalan santrinya masing-masing.</p>
                </div>
                
                <div class="bg-gradient-to-br from-islamic-green to-islamic-dark p-8 rounded-3xl shadow-md text-white flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 opacity-10">
                         <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 relative z-10">Lebih Terstruktur</h3>
                    <p class="text-islamic-light mb-6 relative z-10">Eksplorasi semua kemampuan platform kami secara langsung.</p>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-islamic-gold font-semibold hover:text-white transition-colors relative z-10">
                        Coba Fitur Sekarang <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. How It Works Section -->
    <section id="cara-kerja" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Cara Kerja Hifdz Tracker</h2>
                <p class="text-gray-600">Sistem sederhana yang dirancang khusus untuk alur kerja pesantren.</p>
            </div>

            <div class="relative max-w-4xl mx-auto">
                <div class="absolute left-1/2 -ml-0.5 w-0.5 h-full bg-gray-200 hidden md:block"></div>
                
                <div class="space-y-12">
                    <!-- Step 1 -->
                    <div class="relative flex flex-col md:flex-row items-center md:justify-between group">
                        <div class="md:w-5/12 text-center md:text-right mb-6 md:mb-0">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Daftarkan Pesantren dan Pengajar</h3>
                            <p class="text-gray-600">Mulai dengan membuat akun untuk pesantren dan ustadz/ustadzah.</p>
                        </div>
                        <div class="w-12 h-12 bg-white border-4 border-islamic-green rounded-full flex items-center justify-center relative z-10 font-bold text-islamic-green shadow-sm shadow-islamic-green/20 group-hover:bg-islamic-green group-hover:text-white transition-colors">1</div>
                        <div class="md:w-5/12 hidden md:block"></div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative flex flex-col md:flex-row items-center md:justify-between group">
                        <div class="md:w-5/12 hidden md:block"></div>
                        <div class="w-12 h-12 bg-white border-4 border-islamic-gold rounded-full flex items-center justify-center relative z-10 font-bold text-islamic-gold shadow-sm shadow-islamic-gold/20 group-hover:bg-islamic-gold group-hover:text-white transition-colors">2</div>
                        <div class="md:w-5/12 text-center md:text-left mt-6 md:mt-0">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Tambahkan Data Santri</h3>
                            <p class="text-gray-600">Masukkan daftar santri beserta target hafalan mereka.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative flex flex-col md:flex-row items-center md:justify-between group">
                        <div class="md:w-5/12 text-center md:text-right mb-6 md:mb-0">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Catat Setoran Hafalan</h3>
                            <p class="text-gray-600">Setiap setoran hafalan dicatat langsung dalam sistem.</p>
                        </div>
                        <div class="w-12 h-12 bg-white border-4 border-islamic-green rounded-full flex items-center justify-center relative z-10 font-bold text-islamic-green shadow-sm shadow-islamic-green/20 group-hover:bg-islamic-green group-hover:text-white transition-colors">3</div>
                        <div class="md:w-5/12 hidden md:block"></div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative flex flex-col md:flex-row items-center md:justify-between group">
                        <div class="md:w-5/12 hidden md:block"></div>
                        <div class="w-12 h-12 bg-white border-4 border-islamic-gold rounded-full flex items-center justify-center relative z-10 font-bold text-islamic-gold shadow-sm shadow-islamic-gold/20 group-hover:bg-islamic-gold group-hover:text-white transition-colors">4</div>
                        <div class="md:w-5/12 text-center md:text-left mt-6 md:mt-0">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Pantau Progres Hafalan</h3>
                            <p class="text-gray-600">Lihat perkembangan hafalan setiap santri dengan mudah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Benefits Section -->
    <section class="py-20 bg-islamic-dark text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-islamic-gold">Manfaat Menggunakan Hifdz Tracker</h2>
                    <p class="text-gray-300 mb-8 text-lg">Solusi yang berfokus pada kemudahan, keamanan data, dan peningkatan efisiensi tahfidz.</p>
                    
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-islamic-green/50 p-1.5 rounded-full text-islamic-gold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-lg">Administrasi hafalan menjadi lebih rapi</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-islamic-green/50 p-1.5 rounded-full text-islamic-gold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-lg">Memudahkan ustadz dalam memonitor santri</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-islamic-green/50 p-1.5 rounded-full text-islamic-gold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-lg">Data hafalan tersimpan aman secara digital</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-islamic-green/50 p-1.5 rounded-full text-islamic-gold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-lg">Membantu meningkatkan motivasi santri</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="mt-1 bg-islamic-green/50 p-1.5 rounded-full text-islamic-gold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-lg">Mendukung manajemen pesantren yang lebih modern</span>
                        </li>
                    </ul>
                </div>
                <div class="md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?auto=format&fit=crop&q=80&w=800" alt="Pesantren Illustration" class="rounded-2xl shadow-xl border-4 border-islamic-green/30 opacity-90">
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Testimonials Section -->
    <section id="testimoni" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa Kata Pengguna</h2>
                <p class="text-gray-600">Dipercaya oleh berbagai lembaga pesantren dan madrasah.</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="text-islamic-gold mb-4">
                            <svg class="h-8 w-8 text-islamic-gold/40" fill="currentColor" viewBox="0 0 32 32"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        </div>
                        <p class="text-gray-700 text-lg mb-6 italic">"Sejak menggunakan Hifdz Tracker, pencatatan hafalan santri menjadi jauh lebih rapi dan mudah dipantau."</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-islamic-green/10 rounded-full flex items-center justify-center text-islamic-green font-bold text-xl">
                            A
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Ustadz Ahmad</p>
                            <p class="text-sm text-gray-500">Pengajar Tahfidz</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="text-islamic-gold mb-4">
                            <svg class="h-8 w-8 text-islamic-gold/40" fill="currentColor" viewBox="0 0 32 32"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z"/></svg>
                        </div>
                        <p class="text-gray-700 text-lg mb-6 italic">"Aplikasi ini sangat membantu kami dalam memonitor perkembangan hafalan santri setiap hari."</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-islamic-green/10 rounded-full flex items-center justify-center text-islamic-green font-bold text-xl">
                            P
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Pengurus Pesantren</p>
                            <p class="text-sm text-gray-500">Yayasan Pendidikan Islam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. Final CTA Section -->
    <section class="py-24 bg-islamic-light text-center relative mx-4 sm:mx-6 lg:mx-8 rounded-3xl mb-12 shadow-sm border border-islamic-green/10">
        <div class="absolute inset-0 bg-gradient-to-br from-islamic-green/5 to-islamic-gold/10 rounded-3xl"></div>
        <div class="max-w-3xl mx-auto relative z-10 px-4">
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">Mulai Digitalisasi Manajemen Hafalan di Pesantren Anda</h2>
            <p class="text-lg text-gray-600 mb-10">Gunakan Hifdz Tracker untuk mengelola setoran hafalan santri dengan lebih efisien dan terorganisir.</p>
            <a href="{{ route('dashboard') }}" class="inline-block px-10 py-4 bg-islamic-green text-white font-bold rounded-full hover:bg-islamic-dark hover:scale-105 transition-all duration-300 shadow-xl shadow-islamic-green/30">
                Coba Demo Sekarang
            </a>
        </div>
    </section>

    <!-- 8. Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 pb-8 border-b border-gray-800">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('img/logo.png') }}" class="w-8 h-8 object-contain bg-white rounded-lg p-1" alt="Hifdz Tracker Logo">
                        <span class="font-bold text-xl text-white">Hifdz Tracker</span>
                    </div>
                    <p class="text-gray-400 max-w-sm">Membantu pesantren mencatat dan memantau perkembangan hafalan santri secara terorganisir.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2">
                        <li><a href="#fitur" class="hover:text-islamic-gold transition">Fitur Utama</a></li>
                        <li><a href="#cara-kerja" class="hover:text-islamic-gold transition">Cara Kerja</a></li>
                        <li><a href="#testimoni" class="hover:text-islamic-gold transition">Testimoni</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2">
                        <li>info@hifdztracker.com</li>
                        <li>+62 812-3456-7890</li>
                    </ul>
                    <div class="flex gap-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center text-sm">
                &copy; {{ date('Y') }} Hifdz Tracker. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
