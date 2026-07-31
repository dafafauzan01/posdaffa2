<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-inner">

        <!-- Logo -->
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <div class="sidebar-brand-icon">
                <i class="bi bi-grid-1x2-fill"></i>
            </div>
            <span class="sidebar-brand-text">POS Daffa</span>
        </a>

        <!-- Menu -->
        <nav class="sidebar-nav">
            <span class="sidebar-section-label">Menu</span>

            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ request()->routeIs('dashboard') ? 'sidebar-link-active' : '' }}">
                <i class="bi bi-house-door"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.users') }}"
               class="sidebar-link {{ request()->routeIs('admin.users*') ? 'sidebar-link-active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Pengguna</span>
            </a>

            <a href="{{ route('produk.index') }}"
               class="sidebar-link {{ request()->routeIs('produk*') ? 'sidebar-link-active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Produk</span>
            </a>

            <a href="{{ route('penjualan.index') }}"
               class="sidebar-link {{ request()->routeIs('penjualan*') ? 'sidebar-link-active' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>Penjualan</span>
            </a>
        </nav>

        <!-- User & Logout -->
        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <span class="sidebar-user-name">{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="sidebar-logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </div>
</aside>

<style>
    .app-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: var(--sidebar-width);
        background: var(--sidebar-bg);
        z-index: 1030;
        transition: transform 0.25s ease;
    }

    .sidebar-inner {
        display: flex;
        flex-direction: column;
        height: 100%;
        padding: 1.5rem 1rem;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        padding: 0 0.5rem 1.5rem;
        margin-bottom: 0.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .sidebar-brand-icon {
        width: 42px;
        height: 42px;
        background: var(--accent-primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .sidebar-brand-text {
        color: #ffffff;
        font-weight: 700;
        font-size: 1.15rem;
        letter-spacing: -0.02em;
    }

    .sidebar-section-label {
        display: block;
        color: var(--sidebar-text-muted);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 0 0.75rem;
        margin: 0.5rem 0 0.6rem;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 2px;
        flex: 1;
        overflow-y: auto;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.7rem 0.85rem;
        border-radius: 10px;
        color: var(--sidebar-text);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.92rem;
        transition: all 0.15s ease;
    }

    .sidebar-link i {
        font-size: 1.05rem;
        width: 20px;
        text-align: center;
    }

    .sidebar-link:hover {
        background: var(--sidebar-bg-hover);
        color: #ffffff;
    }

    .sidebar-link-active {
        background: var(--accent-primary);
        color: var(--sidebar-active-text) !important;
        font-weight: 600;
    }

    .sidebar-footer {
        border-top: 1px solid rgba(255,255,255,0.08);
        padding-top: 1rem;
        margin-top: 0.75rem;
    }

    .sidebar-user {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0 0.5rem;
        margin-bottom: 0.85rem;
    }

    .sidebar-user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--accent-primary-soft);
        color: var(--accent-primary-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.85rem;
        flex-shrink: 0;
    }

    .sidebar-user-name {
        color: #ffffff;
        font-weight: 600;
        font-size: 0.88rem;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .sidebar-logout-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: rgba(220, 38, 38, 0.12);
        color: #FCA5A5;
        border: 1px solid rgba(220, 38, 38, 0.2);
        border-radius: 10px;
        padding: 0.6rem;
        font-weight: 600;
        font-size: 0.86rem;
        transition: all 0.15s ease;
    }

    .sidebar-logout-btn:hover {
        background: rgba(220, 38, 38, 0.2);
        color: #ffffff;
    }

    .sidebar-backdrop {
        display: none;
    }

    @media (max-width: 991.98px) {
        .app-sidebar {
            transform: translateX(-100%);
        }

        .app-sidebar.sidebar-open {
            transform: translateX(0);
            box-shadow: 0 0 40px rgba(0,0,0,0.35);
        }

        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            z-index: 1025;
        }

        .sidebar-backdrop.show {
            display: block;
        }
    }
</style>
