<!DOCTYPE html>
<html lang="id" data-theme="{{ \App\Models\Setting::get('theme', 'emerald') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ \App\Models\Setting::get('institution_name', 'Pesantren Darul Ilmi') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --font: 'Inter', sans-serif;
            --radius: 16px;
        }
        /* THEME: Emerald (Default) */
        [data-theme="emerald"] {
            --primary: #059669;
            --primary-dark: #047857;
            --primary-light: #d1fae5;
            --gradient: linear-gradient(135deg, #059669, #0d9488);
        }
        /* Fallback for other themes... using primary for all to keep it simple or inherit */
        
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font);
            background: #f1f5f9;
            color: #1e293b;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23047857\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
            opacity: 0.18;
            z-index: -1;
            pointer-events: none;
        }

        .back-link {
            position: absolute;
            top: 24px;
            left: 24px;
            color: var(--primary-dark, #047857);
            background: var(--primary-light, #d1fae5);
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        .back-link:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 10px rgba(0,0,0,0.08);
            background: var(--primary, #059669);
            color: #fff;
        }

        .login-card {
            background: #fff;
            width: 100%;
            max-width: 400px;
            border-radius: var(--radius);
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .login-header {
            background: var(--gradient, linear-gradient(135deg, #059669, #0d9488));
            padding: 32px 24px;
            text-align: center;
            color: #fff;
        }

        .logo-icon {
            width: 64px;
            height: 64px;
            background: rgba(255,255,255,0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 0 auto 16px;
            backdrop-filter: blur(4px);
        }

        .login-header h1 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .login-header p {
            font-size: 13px;
            opacity: 0.9;
        }

        .login-body {
            padding: 32px 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: var(--font);
            transition: all 0.2s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary, #059669);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
        }

        .btn-submit {
            width: 100%;
            background: var(--gradient, linear-gradient(135deg, #059669, #0d9488));
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(5, 150, 105, 0.3);
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
            border-left: 4px solid #ef4444;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .checkbox-wrapper input {
            accent-color: var(--primary, #059669);
            width: 16px;
            height: 16px;
        }

        .checkbox-wrapper label {
            font-size: 13px;
            color: #64748b;
            cursor: pointer;
            user-select: none;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    
    <a href="{{ url('/') }}" class="back-link">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Beranda
    </a>

    <div class="login-card">
        <div class="login-header">
            @php $logo = \App\Models\Setting::get('logo', ''); @endphp
            @if($logo)
                <img src="{{ Storage::url($logo) }}" alt="Logo" style="width:70px;height:70px;object-fit:cover;border-radius:16px;margin:0 auto 16px;border:2px solid rgba(255,255,255,0.3);box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            @else
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width:70px;height:70px;object-fit:contain;border-radius:16px;margin:0 auto 16px;border:2px solid rgba(255,255,255,0.3);box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            @endif
            <h1>{{ \App\Models\Setting::get('institution_name', 'Pesantren Darul Ilmi') }}</h1>
            <p>Sistem Manajemen Tahfidz</p>
        </div>
        
        <div class="login-body">
            @if ($errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="admin@example.com" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div style="position: relative;">
                        <input type="password" name="password" id="password-input" class="form-control" placeholder="••••••••" required style="padding-right: 48px;">
                        <button type="button" onclick="togglePasswordVisibility('password-input', this)" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); border: none; background: transparent; cursor: pointer; font-size: 16px; padding: 4px; display: flex; align-items: center; justify-content: center; outline: none; user-select: none;">👁️</button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Masuk Disini</button>
                
                <div style="text-align:center; margin-top:20px; font-size:13px; color:#64748b;">
                    Belum punya akun? <a href="{{ route('register') }}" style="color:var(--primary); font-weight:600; text-decoration:none;">Daftar Wali Santri</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Login Loader -->
    <div id="login-loader" style="display: none; position: fixed; inset: 0; background: rgba(255,255,255,0.85); backdrop-filter: blur(8px); z-index: 99999; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.2s ease;">
        <div style="position: relative; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; transform: scale(0.9); transition: transform 0.2s ease;" id="login-loader-content">
            <div style="position: absolute; inset: 0; border: 4px solid #e2e8f0; border-top-color: var(--primary, #059669); border-radius: 50%; animation: spin 1s linear infinite;"></div>
            @if($logo)
                <img src="{{ Storage::url($logo) }}" alt="Logo" style="width:75px;height:75px;object-fit:cover;border-radius:50%;z-index:1;">
            @else
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width:75px;height:75px;object-fit:contain;border-radius:50%;z-index:1;">
            @endif
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const loader = document.getElementById('login-loader');
            loader.style.display = 'flex';
            void loader.offsetWidth;
            loader.style.opacity = '1';
            document.getElementById('login-loader-content').style.transform = 'scale(1)';
        });

        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerText = '🙈';
            } else {
                input.type = 'password';
                btn.innerText = '👁️';
            }
        }
    </script>

</body>
</html>
