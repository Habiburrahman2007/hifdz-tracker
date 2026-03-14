<!DOCTYPE html>
<html lang="id" data-theme="{{ \App\Models\Setting::get('theme', 'emerald') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Manajemen Tahfidz {{ \App\Models\Setting::get('institution_name', 'Pesantren Darul Ilmi') }}">
    <title>@yield('title', 'Dashboard') | {{ \App\Models\Setting::get('institution_name', 'Pesantren Darul Ilmi') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        /* ===== CSS VARIABLES / THEME ENGINE ===== */
        :root {
            --font: 'Inter', sans-serif;
            --radius: 14px;
            --sidebar-w: 260px;
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* THEME: Emerald (Default) */
        [data-theme="emerald"] {
            --primary: #059669;
            --primary-dark: #047857;
            --primary-light: #d1fae5;
            --primary-text: #ffffff;
            --gradient: linear-gradient(135deg, #059669, #0d9488);
            --accent: #f59e0b;
            --nav-bg: #064e3b;
            --nav-text: #a7f3d0;
            --nav-hover: rgba(255,255,255,0.12);
            --nav-active: rgba(255,255,255,0.2);
        }
        /* THEME: Ocean */
        [data-theme="ocean"] {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --primary-text: #ffffff;
            --gradient: linear-gradient(135deg, #0284c7, #6366f1);
            --accent: #f97316;
            --nav-bg: #0c4a6e;
            --nav-text: #bae6fd;
            --nav-hover: rgba(255,255,255,0.12);
            --nav-active: rgba(255,255,255,0.2);
        }
        /* THEME: Sunset */
        [data-theme="sunset"] {
            --primary: #dc2626;
            --primary-dark: #b91c1c;
            --primary-light: #fee2e2;
            --primary-text: #ffffff;
            --gradient: linear-gradient(135deg, #dc2626, #f97316);
            --accent: #fbbf24;
            --nav-bg: #7f1d1d;
            --nav-text: #fca5a5;
            --nav-hover: rgba(255,255,255,0.12);
            --nav-active: rgba(255,255,255,0.2);
        }
        /* THEME: Purple */
        [data-theme="purple"] {
            --primary: #7c3aed;
            --primary-dark: #6d28d9;
            --primary-light: #ede9fe;
            --primary-text: #ffffff;
            --gradient: linear-gradient(135deg, #7c3aed, #db2777);
            --accent: #10b981;
            --nav-bg: #4c1d95;
            --nav-text: #ddd6fe;
            --nav-hover: rgba(255,255,255,0.12);
            --nav-active: rgba(255,255,255,0.2);
        }
        /* THEME: Rose */
        [data-theme="rose"] {
            --primary: #e11d48;
            --primary-dark: #be123c;
            --primary-light: #ffe4e6;
            --primary-text: #ffffff;
            --gradient: linear-gradient(135deg, #e11d48, #a855f7);
            --accent: #06b6d4;
            --nav-bg: #881337;
            --nav-text: #fda4af;
            --nav-hover: rgba(255,255,255,0.12);
            --nav-active: rgba(255,255,255,0.2);
        }
        /* THEME: Amber */
        [data-theme="amber"] {
            --primary: #d97706;
            --primary-dark: #b45309;
            --primary-light: #fef3c7;
            --primary-text: #ffffff;
            --gradient: linear-gradient(135deg, #d97706, #16a34a);
            --accent: #2563eb;
            --nav-bg: #78350f;
            --nav-text: #fde68a;
            --nav-hover: rgba(255,255,255,0.12);
            --nav-active: rgba(255,255,255,0.2);
        }

        /* ===== RESET & BASE ===== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font);
            background: #f1f5f9;
            color: #1e293b;
            display: flex;
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.6;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--nav-bg);
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            overflow: hidden;
            transition: var(--transition);
        }
        .sidebar-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .logo-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .logo-icon {
            width: 46px;
            height: 46px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(0,0,0,0.3);
        }
        .logo-text h1 {
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }
        .logo-text span {
            font-size: 11px;
            color: var(--nav-text);
            opacity: 0.8;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }
        .nav-section {
            margin-bottom: 8px;
        }
        .nav-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--nav-text);
            opacity: 0.5;
            padding: 8px 8px 4px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--nav-text);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: var(--transition);
            margin-bottom: 2px;
            position: relative;
        }
        .nav-item:hover {
            background: var(--nav-hover);
            color: #fff;
        }
        .nav-item.active {
            background: var(--nav-active);
            color: #fff;
            font-weight: 600;
        }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 3px;
            background: #fff;
            border-radius: 0 3px 3px 0;
        }
        .nav-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }
        /* Color-coded nav icons per menu */
        .nav-item[data-menu="dashboard"] .nav-icon { background: rgba(99,102,241,0.25); }
        .nav-item[data-menu="students"] .nav-icon { background: rgba(16,185,129,0.25); }
        .nav-item[data-menu="teachers"] .nav-icon { background: rgba(245,158,11,0.25); }
        .nav-item[data-menu="setoran"] .nav-icon { background: rgba(239,68,68,0.25); }
        .nav-item[data-menu="reports"] .nav-icon { background: rgba(139,92,246,0.25); }
        .nav-item[data-menu="settings"] .nav-icon { background: rgba(75,85,99,0.25); }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-footer p {
            font-size: 11px;
            color: var(--nav-text);
            opacity: 0.5;
            text-align: center;
        }

        /* ===== MAIN CONTENT ===== */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 28px;
            height: 66px;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 50;
            gap: 16px;
        }
        .topbar-title {
            flex: 1;
        }
        .topbar-title h2 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }
        .topbar-title p {
            font-size: 12px;
            color: #94a3b8;
        }
        .topbar-date {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ===== PAGE CONTENT ===== */
        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* ===== CARDS ===== */
        .card {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            transition: var(--transition);
        }
        .card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .card-header {
            padding: 18px 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-header h3 {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            flex: 1;
        }
        .card-body {
            padding: 22px;
        }

        /* ===== STAT CARDS ===== */
        .stat-card {
            border-radius: var(--radius);
            padding: 22px;
            position: relative;
            overflow: hidden;
            color: #fff;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }
        .stat-card::after {
            content: '';
            position: absolute;
            right: 20px;
            bottom: -30px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }
        .stat-card-icon {
            font-size: 28px;
            margin-bottom: 12px;
            display: block;
        }
        .stat-card-value {
            font-size: 32px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }
        .stat-card-label {
            font-size: 12px;
            opacity: 0.85;
            font-weight: 500;
        }

        /* ===== GRID SYSTEM ===== */
        .grid { display: grid; gap: 20px; }
        .grid-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }
        .grid-5 { grid-template-columns: repeat(5, 1fr); }

        /* ===== TABLE ===== */
        .table-wrapper {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            background: #f8fafc;
            padding: 12px 14px;
            text-align: left;
            font-size: 11.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
            cursor: pointer;
            user-select: none;
        }
        thead th:hover { background: #f1f5f9; color: #334155; }
        tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: var(--transition);
        }
        tbody tr:hover { background: #f8fafc; }
        tbody td {
            padding: 13px 14px;
            font-size: 13.5px;
            color: #334155;
            vertical-align: middle;
        }

        /* ===== BADGES ===== */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            gap: 4px;
        }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #e0f2fe; color: #0c4a6e; }
        .badge-secondary { background: #f1f5f9; color: #475569; }
        .badge-primary { background: var(--primary-light); color: var(--primary-dark); }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: var(--transition);
            text-decoration: none;
            white-space: nowrap;
        }
        .btn-primary {
            background: var(--gradient);
            color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(0,0,0,0.2); }
        .btn-secondary { background: #f1f5f9; color: #475569; }
        .btn-secondary:hover { background: #e2e8f0; }
        .btn-danger { background: #fee2e2; color: #991b1b; }
        .btn-danger:hover { background: #fecaca; }
        .btn-success { background: #d1fae5; color: #065f46; }
        .btn-success:hover { background: #a7f3d0; }
        .btn-sm { padding: 5px 12px; font-size: 12px; border-radius: 8px; }
        .btn-icon { padding: 7px; }

        /* ===== FORMS ===== */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13.5px;
            font-family: var(--font);
            color: #1e293b;
            background: #fff;
            transition: var(--transition);
            outline: none;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(5,150,105,0.12);
        }
        select.form-control { cursor: pointer; }
        textarea.form-control { resize: vertical; min-height: 90px; }

        /* ===== PROGRESS BAR ===== */
        .progress {
            height: 8px;
            background: #e2e8f0;
            border-radius: 99px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            background: var(--gradient);
            border-radius: 99px;
            transition: width 0.6s ease;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        .alert-error { background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; }

        /* ===== FILTERS BAR ===== */
        .filter-bar {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .filter-bar .form-control {
            width: auto;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: center;
            padding: 16px 22px;
            border-top: 1px solid #f1f5f9;
        }
        .pagination a, .pagination span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }
        .pagination a { background: #f1f5f9; color: #475569; }
        .pagination a:hover { background: var(--primary-light); color: var(--primary-dark); }
        .pagination span.active {
            background: var(--gradient);
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        /* ===== AVATAR ===== */
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            flex-shrink: 0;
        }
        .avatar-male { background: #dbeafe; color: #1d4ed8; }
        .avatar-female { background: #fce7f3; color: #be185d; }

        /* ===== RANK BADGE ===== */
        .rank-badge {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
        }
        .rank-1 { background: #fef3c7; color: #d97706; }
        .rank-2 { background: #f1f5f9; color: #475569; }
        .rank-3 { background: #fee2e2; color: #c2410c; }
        .rank-n { background: #f0fdf4; color: #166534; font-size: 11px; }

        /* ===== MODAL ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: var(--transition);
        }
        .modal-overlay.show {
            opacity: 1;
            pointer-events: all;
        }
        .modal {
            background: #fff;
            border-radius: 20px;
            padding: 28px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.9);
            transition: var(--transition);
        }
        .modal-overlay.show .modal {
            transform: scale(1);
        }
        .modal-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
        }

        /* ===== SCORE WIDGET ===== */
        .score-widget {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .score-display {
            font-size: 24px;
            font-weight: 800;
            min-width: 54px;
            text-align: center;
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 4px 10px;
            border-radius: 10px;
        }
        .score-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        .score-btn-minus { background: #fee2e2; color: #dc2626; }
        .score-btn-minus:hover { background: #fecaca; transform: scale(1.05); }
        .score-btn-plus { background: #d1fae5; color: #059669; }
        .score-btn-plus:hover { background: #a7f3d0; transform: scale(1.05); }

        /* ===== SECTION HEADER ===== */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
        }
        .section-header-icon {
            width: 44px;
            height: 44px;
            background: var(--gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        .section-header-text h1 { font-size: 20px; font-weight: 800; color: #0f172a; }
        .section-header-text p { font-size: 13px; color: #64748b; }
        .section-header-actions { margin-left: auto; display: flex; gap: 10px; }

        /* ===== JUZ PROGRESS CARD ===== */
        .juz-progress {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .juz-dot {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 700;
            color: #94a3b8;
        }
        .juz-dot.completed { background: var(--gradient); color: #fff; }
        .juz-dot.partial { background: var(--primary-light); color: var(--primary-dark); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            :root { --sidebar-w: 220px; }
            .grid-4 { grid-template-columns: repeat(2, 1fr); }
            .grid-5 { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 768px) {
            :root { --sidebar-w: 0px; }
            .sidebar { transform: translateX(-260px); width: 260px; }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .grid-2, .grid-3, .grid-4 { grid-template-columns: 1fr; }
            .page-content { padding: 16px; }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in { animation: fadeInUp 0.4s ease both; }
        .fade-in-1 { animation-delay: 0.05s; }
        .fade-in-2 { animation-delay: 0.1s; }
        .fade-in-3 { animation-delay: 0.15s; }
        .fade-in-4 { animation-delay: 0.2s; }
        .fade-in-5 { animation-delay: 0.25s; }
        .fade-in-6 { animation-delay: 0.3s; }

        /* Misc */
        .text-muted { color: #94a3b8; }
        .text-sm { font-size: 12px; }
        .text-xs { font-size: 11px; }
        .fw-700 { font-weight: 700; }
        .fw-800 { font-weight: 800; }
        .mb-0 { margin-bottom: 0; }
        .mb-4 { margin-bottom: 4px; }
        .mb-8 { margin-bottom: 8px; }
        .mb-16 { margin-bottom: 16px; }
        .mb-20 { margin-bottom: 20px; }
        .mb-24 { margin-bottom: 24px; }
        .mt-16 { margin-top: 16px; }
        .mt-20 { margin-top: 20px; }
        .flex { display: flex; }
        .flex-wrap { flex-wrap: wrap; }
        .items-center { align-items: center; }
        .gap-8 { gap: 8px; }
        .gap-12 { gap: 12px; }
        .gap-16 { gap: 16px; }
        .ml-auto { margin-left: auto; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .w-full { width: 100%; }

        /* Delete confirm */
        .delete-form { display: inline; }

        /* Chart container */
        .chart-container { position: relative; width: 100%; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: #94a3b8;
        }
        .empty-state-icon { font-size: 48px; margin-bottom: 12px; }
        .empty-state p { font-size: 14px; }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-box">
                @php $logo = \App\Models\Setting::get('logo', ''); @endphp
                {{-- Dynamic Logo (commented for now since storage link isn't configured)
                @if($logo)
                    <img src="{{ Storage::url($logo) }}" alt="Logo" style="width:46px;height:46px;object-fit:cover;border-radius:12px;">
                @else
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width:60px;height:60px;object-fit:contain;border-radius:12px;">
                @endif
                --}}
                <!-- Static Logo -->
                <img src="{{ asset('img/logo.png') }}" class="shadow-sm border border-gray-100" alt="Logo" style="width:50px;height:50px;object-fit:contain;border-radius:8px;">
                <div class="logo-text">
                    <h1>{{ \App\Models\Setting::get('institution_name', 'Pesantren Darul Ilmi') }}</h1>
                    <span>Sistem Manajemen Tahfidz</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-label">Utama</div>
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" data-menu="dashboard">
                    <div class="nav-icon">🏠</div>
                    Dashboard
                </a>
            </div>
            <div class="nav-section">
                <div class="nav-label">Manajemen</div>
                <a href="{{ route('students.index') }}" class="nav-item {{ request()->routeIs('students.*') ? 'active' : '' }}" data-menu="students">
                    <div class="nav-icon">👨‍🎓</div>
                    Data Santri
                </a>
                <a href="{{ route('teachers.index') }}" class="nav-item {{ request()->routeIs('teachers.*') ? 'active' : '' }}" data-menu="teachers">
                    <div class="nav-icon">👨‍🏫</div>
                    Data Ustadz
                </a>
                <a href="{{ route('setoran.index') }}" class="nav-item {{ request()->routeIs('setoran.*') ? 'active' : '' }}" data-menu="setoran">
                    <div class="nav-icon">📝</div>
                    Setoran Hafalan
                </a>
            </div>
            <div class="nav-section">
                <div class="nav-label">Analisis</div>
                <a href="{{ route('reports.index') }}" class="nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}" data-menu="reports">
                    <div class="nav-icon">📊</div>
                    Laporan Bulanan
                </a>
            </div>
            <div class="nav-section">
                <div class="nav-label">Sistem</div>
                <a href="{{ route('settings.index') }}" class="nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}" data-menu="settings">
                    <div class="nav-icon">⚙️</div>
                    Pengaturan
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <p>© 2025 Darul Ilmi v1.0</p>
        </div>
    </aside>

    <!-- Main -->
    <main class="main">
        <!-- Topbar -->
        <header class="topbar">
            <button onclick="document.getElementById('sidebar').classList.toggle('open')" class="btn btn-secondary btn-icon" style="display:none" id="menu-toggle">☰</button>
            <div class="topbar-title">
                <h2>@yield('page-title', 'Dashboard')</h2>
                <p>@yield('page-subtitle', 'Selamat datang di Sistem Manajemen Tahfidz')</p>
            </div>
            <div class="topbar-date">
                📅 {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </div>
        </header>

        <!-- Flash Messages -->
        @if(session('success'))
            <div style="padding: 0 28px; padding-top: 16px;">
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            </div>
        @endif
        @if(session('error'))
            <div style="padding: 0 28px; padding-top: 16px;">
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            </div>
        @endif

        <!-- Page Content -->
        <div class="page-content">
            @yield('content')
        </div>
    </main>

    <script>
        // Mobile menu toggle visibility
        if (window.innerWidth <= 768) {
            document.getElementById('menu-toggle').style.display = 'flex';
        }
        window.addEventListener('resize', () => {
            document.getElementById('menu-toggle').style.display = window.innerWidth <= 768 ? 'flex' : 'none';
        });

        // Auto dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                el.style.opacity = '0';
                el.style.transition = 'opacity 0.4s ease';
                setTimeout(() => el.remove(), 400);
            });
        }, 4000);

        // Table sort (client-side for small tables)
        document.querySelectorAll('thead th[data-sort]').forEach(th => {
            th.addEventListener('click', () => {
                const table = th.closest('table');
                const tbody = table.querySelector('tbody');
                const col = Array.from(th.parentElement.children).indexOf(th);
                const asc = th.dataset.dir !== 'asc';
                th.dataset.dir = asc ? 'asc' : 'desc';
                const rows = Array.from(tbody.querySelectorAll('tr'));
                rows.sort((a, b) => {
                    const va = a.cells[col]?.dataset.val || a.cells[col]?.textContent.trim() || '';
                    const vb = b.cells[col]?.dataset.val || b.cells[col]?.textContent.trim() || '';
                    return asc ? va.localeCompare(vb, 'id', {numeric: true}) : vb.localeCompare(va, 'id', {numeric: true});
                });
                rows.forEach(r => tbody.appendChild(r));
                // update sort icon
                table.querySelectorAll('thead th').forEach(h => h.innerHTML = h.innerHTML.replace(/ [▲▼]$/, ''));
                th.innerHTML += asc ? ' ▲' : ' ▼';
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
