<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hifdz Tracker - Kelola Hafalan Al-Quran dengan Mudah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(90deg, #38bdf8, #818cf8);
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="antialiased text-slate-800">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200">
                        H
                    </div>
                    <span class="font-bold text-xl text-slate-900 tracking-tight">Hifdz Tracker</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#fitur" class="text-slate-600 hover:text-indigo-600 font-medium transition">Fitur</a>
                    <a href="#tentang" class="text-slate-600 hover:text-indigo-600 font-medium transition">Tentang</a>
                </div>
                <div>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-indigo-600 hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200 transition-all duration-200 transform hover:-translate-y-0.5">
                        Buka Aplikasi
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-slate-50">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-[0.03]"></div>
            <div class="absolute top-0 right-0 -translate-y-12 translate-x-1/3 w-[800px] h-[800px] bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 translate-y-1/3 -translate-x-1/3 w-[600px] h-[600px] bg-blue-100 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-900">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-slate-200 shadow-sm text-sm font-medium text-slate-600 mb-8 animate-fade-in-up">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                Aplikasi Manajemen Tahfidz Modern
            </div>
            
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8 animate-fade-in-up delay-100 leading-tight">
                Kelola Hafalan Al-Quran <br class="hidden md:block" />
                dengan <span class="text-gradient">Lebih Mudah</span>
            </h1>
            
            <p class="mt-4 max-w-2xl mx-auto text-lg md:text-xl text-slate-600 mb-10 animate-fade-in-up delay-200 leading-relaxed">
                Pantau perkembangan capaian hafalan santri, catat setoran harian, dan ciptakan ekosistem tahfidz yang terstruktur untuk generasi Qurani.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in-up delay-300">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-semibold rounded-full text-white bg-indigo-600 hover:bg-indigo-700 hover:shadow-xl hover:shadow-indigo-200 transition-all duration-300 transform hover:-translate-y-1">
                    Mulai Sekarang
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="#fitur" class="inline-flex items-center justify-center px-8 py-3.5 border border-slate-300 text-base font-semibold rounded-full text-slate-700 bg-white hover:bg-slate-50 transition-all duration-300">
                    Pelajari Fitur
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="fitur" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-indigo-600 font-semibold tracking-wide uppercase text-sm mb-3">Keunggulan</h2>
                <p class="mt-2 text-3xl md:text-4xl font-bold text-slate-900 tracking-tight">Semua yang Anda butuhkan untuk program tahfidz</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 group">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center mb-6 text-indigo-600 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Manajemen Tepat</h3>
                    <p class="text-slate-600 leading-relaxed">Kelola data ustadz/ustadzah dan santri dengan sistematis dalam satu platform terpusat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 group mt-0 md:mt-8">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center mb-6 text-purple-600 group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Pencatatan Setoran</h3>
                    <p class="text-slate-600 leading-relaxed">Catat kualitas hafalan, kelancaran, dan makhroj secara detail setiap kali setoran.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 group mt-0 md:mt-16">
                    <div class="w-14 h-14 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center mb-6 text-blue-600 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Laporan Otomatis</h3>
                    <p class="text-slate-600 leading-relaxed">Hasilkan grafik dan laporan progres santri yang riil untuk evaluasi yang lebih efektif.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang Section (Simple representation) -->
    <div id="tentang" class="py-24 bg-slate-50 relative border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-3xl blur-lg opacity-30"></div>
                    <div class="relative bg-white rounded-3xl p-8 border border-slate-100 shadow-sm aspect-square flex items-center justify-center">
                        <div class="w-32 h-32 rounded-full bg-indigo-50 flex items-center justify-center mb-6 text-indigo-600 floating shadow-inner">
                             <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z" /></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:w-1/2">
                <h2 class="text-indigo-600 font-semibold tracking-wide uppercase text-sm mb-3">Tentang Kami</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-slate-900 tracking-tight mb-6">Mewujudkan Generasi Penghafal Al-Quran</h3>
                <p class="text-slate-600 text-lg leading-relaxed mb-6">
                    Hifdz Tracker dirancang untuk mempermudah operasional lembaga tahfidz dalam mengelola kegiatan akademik, memastikan progres hafalan setiap santri tercatat dengan baik, transparan, dan dapat dievaluasi secara berkala.
                </p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center text-slate-700">
                        <svg class="w-6 h-6 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Mudah digunakan oleh semua kalangan
                    </li>
                    <li class="flex items-center text-slate-700">
                        <svg class="w-6 h-6 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Aman dan tersimpan di cloud
                    </li>
                    <li class="flex items-center text-slate-700">
                        <svg class="w-6 h-6 text-emerald-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Fitur yang terus berkembang
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="hero-gradient py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap meningkatkan kualitas tahfidz Anda?</h2>
            <p class="text-indigo-200 text-lg mb-10 max-w-2xl mx-auto">Bergabung bersama sistem digitalisasi pondok pesantren dan madrasah dalam memonitor perkembangan Al-Quran.</p>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-full text-indigo-900 bg-white hover:bg-slate-50 hover:scale-105 transition-all duration-300 shadow-[0_0_30px_rgba(255,255,255,0.3)]">
                Ke Dashboard Utama
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center pb-8 border-b border-slate-100 mb-8">
                <div class="flex items-center gap-2 mb-4 md:mb-0">
                    <div class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-bold text-sm">H</div>
                    <span class="font-bold text-lg text-slate-900">Hifdz Tracker</span>
                </div>
                <div class="text-sm text-slate-500">
                    Dirancang untuk kemudahan manajemen tahfidz
                </div>
            </div>
            <div class="text-center text-slate-500 text-sm">
                &copy; {{ date('Y') }} Hifdz Tracker. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll for anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
