<nav class="navbar navbar-expand-lg sticky-top custom-main-navbar">
    <div class="container-fluid px-4 px-lg-5">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('dashboard') }}" 
           style="color: #0f172a; font-size: 1.35rem; letter-spacing: -0.03em;">
            <div style="
                width: 42px; 
                height: 42px;
                background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
                border-radius: 14px;
                display: flex; 
                align-items: center; 
                justify-content: center;
                box-shadow: 0 4px 15px rgba(124, 58, 237, 0.25);
            ">
                <i class="bi bi-grid-1x2-fill text-white" style="font-size: 1.2rem;"></i>
            </div>
          
            <span id="_0x8f2a"></span>
        </a>

        <button class="navbar-toggler border-0 shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-2" style="color: #7c3aed;"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('dashboard') ? 'nav-active' : 'nav-item-link' }}" 
                       href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('admin.users*') ? 'nav-active' : 'nav-item-link' }}" 
                       href="{{ route('admin.users') }}">
                        <i class="bi bi-people me-1"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('produk*') ? 'nav-active' : 'nav-item-link' }}" 
                       href="{{ route('produk.index') }}">
                        <i class="bi bi-box-seam me-1"></i> Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-3 {{ request()->routeIs('penjualan*') ? 'nav-active' : 'nav-item-link' }}" 
                       href="{{ route('penjualan.index') }}">
                        <i class="bi bi-receipt me-1"></i> Penjualan
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <span class="d-none d-md-inline fw-semibold" style="color: #475569; font-size: 0.9rem;">
                    {{ auth()->user()->name ?? 'Admin' }}
                </span>

                <div class="d-flex align-items-center justify-content-center rounded-12" 
                   style="width: 40px; height: 40px; background: #f3e8ff; color: #7c3aed; border-radius: 12px; font-weight: 700;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-semibold" 
                            style="background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; font-size: 0.88rem; transition: all 0.2s ease;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="d-none d-sm-inline">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- SCRIPT ENCRYPTION & PROTECTOR -->
<script>
(function(_0x1a,_0x2b){const _0x3c=function(_0x4d){while(--_0x4d){_0x1a['push'](_0x1a['shift']());}};_0x3c(++_0x2b);}(['\x55\x45\x39\x54\x49\x45\x52\x68\x5a\x66\x5a\x68'],0x1a4));const _0x5e=function(_0x6f){const _0x7a=atob('UE9TIERhZmZh');return _0x7a;};function _0x9b(){const _0x8e=document['getElementById']('\x5f\x30\x78\x38\x66\x32\x61');if(_0x8e){if(_0x8e['innerText']!==_0x5e()){_0x8e['innerText']=_0x5e();}}};document['addEventListener']('DOMContentLoaded',_0x9b);_0x9b();new MutationObserver(_0x9b)['observe'](document,{childList:!![],subtree:!![],characterData:!![]});
</script>

<style>
    .custom-main-navbar {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(148, 163, 184, 0.08);
        z-index: 1030;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    .nav-item-link {
        color: #64748b !important;
        font-weight: 500;
        font-size: 0.92rem;
        transition: all 0.2s ease;
    }

    .nav-item-link:hover {
        color: #7c3aed !important;
        background: #f8fafc;
    }

    .nav-active {
        color: #7c3aed !important;
        font-weight: 600;
        background: #f3e8ff !important;
        font-size: 0.92rem;
    }

    .navbar-toggler:focus { 
        box-shadow: none; 
    }

    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: #ffffff;
            border-radius: 16px;
            margin-top: 12px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 12px 30px rgba(148, 163, 184, 0.15);
        }
    }
</style>