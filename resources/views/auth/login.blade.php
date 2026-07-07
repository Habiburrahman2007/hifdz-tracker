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
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="logo-icon">📖</div>
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
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="checkbox-wrapper">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn-submit">Sign In</button>
            </form>
        </div>
    </div>

</body>
</html>
