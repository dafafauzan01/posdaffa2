<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            /* ==== Palet warna utama (krem hangat + ungu-indigo, tanpa abu2/hijau) ==== */
            --bg-page:        #FAF8F4;
            --bg-card:        #FFFFFF;
            --border-color:   #E9E2D6;

            --text-primary:   #2B2A28;
            --text-secondary: #57534C;
            --text-muted:     #8A8478;

            --accent-primary:      #6D4FD1;
            --accent-primary-dark: #5B3FC0;
            --accent-primary-soft: #ECE6FB;

            --accent-success:      #0E7C86;
            --accent-success-soft: #DFF3F4;

            --accent-warning:      #B45309;
            --accent-warning-soft: #FBEBD2;

            --accent-danger:      #B91C1C;
            --accent-danger-soft: #FBE4E1;

            --sidebar-bg:          #241F4E;
            --sidebar-bg-hover:    #322A69;
            --sidebar-text:        #C9C2E8;
            --sidebar-text-muted:  #8E85BE;
            --sidebar-active-bg:   #6D4FD1;
            --sidebar-active-text: #FFFFFF;
            --sidebar-width:       264px;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--bg-page);
            color: var(--text-primary);
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            margin: 0;
        }

        /* ==== Shell: sidebar kiri + konten kanan ==== */
        .app-shell {
            display: flex;
            min-height: 100vh;
        }

        .app-main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* margin-left hanya diberikan kalau sidebar sedang tampil (user sudah login) */
        .app-main-with-sidebar {
            margin-left: var(--sidebar-width);
        }

        .app-topbar {
            display: none;
            align-items: center;
            justify-content: space-between;
            background: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 0.85rem 1.25rem;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        @media (max-width: 991.98px) {
            .app-main-with-sidebar { margin-left: 0; }
            .app-topbar { display: flex; }
        }
    </style>
</head>
<body>

    <div class="app-shell">
        @if(auth()->check())
            @include('layouts.navbar')
        @endif

        <div class="app-main @if(auth()->check()) app-main-with-sidebar @endif">
            @if(auth()->check())
                <!-- Topbar hanya tampil di mobile, untuk membuka sidebar -->
                <div class="app-topbar">
                    <button class="btn border-0 p-0" type="button" onclick="document.getElementById('appSidebar').classList.toggle('sidebar-open'); document.getElementById('sidebarBackdrop').classList.toggle('show');">
                        <i class="bi bi-list fs-2" style="color: var(--accent-primary);"></i>
                    </button>
                    <span class="fw-bold" style="color: var(--text-primary);">POS Daffa</span>
                    <span style="width:32px"></span>
                </div>
                <div id="sidebarBackdrop" class="sidebar-backdrop" onclick="document.getElementById('appSidebar').classList.remove('sidebar-open'); this.classList.remove('show');"></div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

</body>
</html>
