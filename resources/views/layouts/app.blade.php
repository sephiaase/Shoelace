<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoelace</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.0.0/webfont/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <i class="ti ti-shoe"></i>
            </div>
            <span class="logo-text">
                SHOELACE
            </span>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-group-label">
                Analitik
            </div>
            <a href="{{ route('dashboard') }}"
                class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('persediaan') }}"
                class="nav-item {{ request()->routeIs('persediaan') ? 'active' : '' }}">
                Persediaan Barang
            </a>

            <div class="nav-group-label">
                Master Data
            </div>

            <a href="{{ route('kategori.index') }}"
                class="nav-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                Kategori Barang
            </a>

            <a href="{{ route('barang.index') }}"
                class="nav-item {{ request()->routeIs('barang.*') ? 'active' : '' }}">
                Daftar Barang
            </a>

            <a href="{{ route('user.index') }}"
                class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                Manajemen Pengguna
            </a>

            <div class="nav-group-label">
                Dokumentasi
            </div>

            <a href="{{ route('laporan') }}"
                class="nav-item {{ request()->routeIs('laporan*') ? 'active' : '' }}">
                Laporan
            </a>
        </nav>

    </aside>
    <div class="main">
        <header class="topbar">
            <div class="search-wrap">
                <div class="search-wrap-inner">
                    <i class="ti ti-search search-icon"></i>
                    <input
                        class="search-box"
                        type="text"
                        placeholder="Search...">
                    <span class="search-hint">
                        ⌘ F
                    </span>
                </div>
            </div>
            <div class="topbar-right">

                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>

                <span class="user-name">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}"
                    method="POST"
                    style="display:inline">

                    @csrf

                    <button type="submit"
                        style="
                            border:none;
                            background:none;
                            cursor:pointer;
                            color:#666;
                            font-size:12px;">
                        Logout
                    </button>

                </form>

            </div>

        </header>

        @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

        @endif

        @yield('content')
    </div>

    <!-- MODAL CRUD -->
    <div class="crud-modal" id="crudModal">
        <div class="crud-box">
            <h3 id="modalTitle">
                Tambah Data
            </h3>
            <input
                type="text"
                placeholder="Nama Data">
            <div class="crud-actions">
                <button onclick="closeModal()">
                    Batal
                </button>
                <button class="btn-save">
                    Simpan
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>