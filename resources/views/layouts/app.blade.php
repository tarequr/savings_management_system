<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Saving Management System') }}</title>

        <!-- Google Fonts: Public Sans -->
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Custom Styles -->
        <style>
            :root {
                --sidebar-bg: #1a2a4e;
                --sidebar-hover: #24355d;
                --sidebar-active: #2c3d94;
                --primary: #2c3d94;
                --bg-light: #f8fbff;
                --text-main: #2d3436;
            }
            body { 
                font-family: 'Public Sans', sans-serif; 
                background-color: var(--bg-light);
                color: var(--text-main);
            }
            #wrapper { display: flex; width: 100%; align-items: stretch; }
            #sidebar {
                min-width: 260px;
                max-width: 260px;
                background: var(--sidebar-bg);
                color: #ffffff;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                min-height: 100vh;
                position: relative;
                z-index: 1000;
            }
            #sidebar.active { margin-left: -260px; }
            #sidebar .sidebar-header { 
                padding: 25px 20px; 
                background: rgba(0,0,0,0.1); 
                text-align: left;
                border-bottom: 1px solid rgba(255,255,255,0.05);
            }
            #sidebar .brand-name {
                font-size: 1.1rem;
                font-weight: 700;
                letter-spacing: -0.02em;
            }
            
            #sidebar ul.components { padding: 15px 0; }
            #sidebar ul li a {
                padding: 12px 25px;
                font-size: 0.95rem;
                font-weight: 500;
                display: flex;
                align-items: center;
                color: rgba(255, 255, 255, 0.7);
                text-decoration: none;
                transition: 0.2s;
            }
            #sidebar ul li a i { width: 20px; font-size: 1.1rem; margin-right: 12px; opacity: 0.8; }
            #sidebar ul li a:hover { 
                color: #ffffff; 
                background: var(--sidebar-hover);
            }
            #sidebar ul li.active > a { 
                color: #ffffff; 
                background: var(--sidebar-active);
                position: relative;
            }
            #sidebar ul li.active > a::after {
                content: '';
                position: absolute;
                right: 0;
                top: 0;
                height: 100%;
                width: 4px;
                background: #fff;
            }
            
            #content { width: 100%; padding: 0; min-height: 100vh; transition: all 0.3s; }
            .navbar { 
                padding: 1rem 1.5rem; 
                background: #ffffff; 
                border-bottom: 1px solid rgba(0,0,0,0.05);
                box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            }
            
            .content-area { padding: 2rem; }
            .page-title { 
                font-weight: 700; 
                font-size: 1.5rem;
                color: var(--text-main);
                margin-bottom: 1.5rem;
                letter-spacing: -0.02em;
            }

            .card { border: none; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
            .card-header { background: #fff; padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f4f9; }
            .card-title { font-weight: 700; font-size: 1rem; color: #1a202c; margin-bottom: 0; }
            
            .btn-action {
                border-radius: 6px;
                font-weight: 600;
                font-size: 0.85rem;
                padding: 0.5rem 1rem;
            }

            @media (max-width: 768px) {
                #sidebar { margin-left: -260px; }
                #sidebar.active { margin-left: 0; }
            }
        </style>
    </head>
    <body class="antialiased">
        <div id="wrapper">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Page Content -->
            <div id="content">
                <!-- Top Nav -->
                @include('layouts.top-nav')

                <div class="content-area">
                    @isset($header)
                        <h2 class="page-title">{{ $header }}</h2>
                    @endisset

                    {{ $slot }}

                    <footer class="py-5 text-center text-muted small mt-5 border-top">
                        &copy; {{ date('Y') }} Saving Management System. Developed by Nextgen Innovation.
                    </footer>
                </div>
            </div>
        </div>

        <!-- jQuery & Bootstrap 5 JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
    </body>
</html>
