<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Saving Management System') }}</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            :root {
                --primary-color: #2c3d94;
                --text-main: #2d3436;
                --text-muted: #636e72;
            }
            body { 
                font-family: 'Public Sans', sans-serif; 
                background-color: #f8fbff;
                color: var(--text-main);
                margin: 0;
                padding: 0;
            }
            .auth-wrapper {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                position: relative;
                overflow: hidden;
                padding: 2rem;
            }
            .sidebar-bg {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 30vh;
                background-image: url('{{ asset('assets/images/cityscape_pro.png') }}');
                background-position: center bottom;
                background-repeat: no-repeat;
                background-size: cover;
                opacity: 0.15;
                z-index: 1;
            }
            .auth-card {
                width: 100%;
                max-width: 420px;
                background: #ffffff;
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03);
                border: 1px solid rgba(0,0,0,0.05);
                padding: 2.5rem;
                position: relative;
                z-index: 2;
            }
            .brand-section {
                margin-bottom: 2rem;
                text-align: center;
            }
            .brand-title {
                color: var(--primary-color);
                font-weight: 700;
                font-size: 1.5rem;
                letter-spacing: -0.02em;
                margin-bottom: 0.25rem;
            }
            .brand-subtitle {
                color: var(--text-muted);
                font-size: 0.85rem;
                font-weight: 400;
            }
            .form-label {
                font-weight: 600;
                font-size: 0.85rem;
                color: var(--text-main);
                margin-bottom: 0.5rem;
            }
            .form-control {
                border-radius: 6px;
                padding: 0.75rem 1rem;
                border: 1px solid #e2e8f0;
                font-size: 0.95rem;
                color: var(--text-main);
                transition: all 0.2s;
            }
            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(44, 61, 148, 0.1);
            }
            .btn-primary {
                background-color: var(--primary-color);
                border: none;
                padding: 0.75rem;
                font-weight: 600;
                font-size: 0.95rem;
                border-radius: 6px;
                transition: all 0.2s;
            }
            .btn-primary:hover {
                background-color: #243280;
                transform: translateY(-1px);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="auth-wrapper">
            <div class="brand-section">
                <div class="brand-title">Saving Management System</div>
                <div class="brand-subtitle text-uppercase tracking-wider">Financial Excellence & Transparency</div>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>

            <div class="sidebar-bg"></div>
        </div>

        <!-- jQuery & Bootstrap 5 JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
