<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shoelace — Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.0.0/webfont/tabler-icons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

<!-- ── Sidebar ── -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon"><i class="ti ti-shoe"></i></div>
    <span class="logo-text">shoelace</span>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-item active" data-page="dashboard" onclick="navigate('dashboard', this)">
      <i class="ti ti-layout-dashboard"></i> Dashboard
    </div>

    <div class="nav-item" data-page="persediaan" onclick="navigate('persediaan', this)">
      <i class="ti ti-package"></i>
      Persediaan Barang
    </div>

    <li class="nav-group">

      <button class="nav-parent" id="masterDataToggle" type="button">
        <span>
          <sl-icon name="folder"></sl-icon>
          Master Data
        </span>
        <sl-icon name="chevron-down" id="masterChevron"></sl-icon>
      </button>

      <ul class="sub-menu" id="masterDataMenu">
        <li>
        <button type="button" class="submenu-link" onclick="openMasterSection('kategori', this)">
            Kategori Barang
        </button>
        </li>

        <li>
        <button type="button" class="submenu-link" onclick="openMasterSection('barang', this)">
            Daftar Barang
          </button>
        </li>

        <li>
        <button type="button" class="submenu-link" onclick="openMasterSection('user', this)">
            Manajemen Pengguna
          </button>
        </li>
      </ul>
    </li>

    <div class="nav-item" onclick="navigate('laporan', this)" data-page="laporan">
      <i class="ti ti-file-analytics"></i> Laporan
    </div>
  </nav>
</aside>


<!-- ── Main ── -->
<div class="main">

  <!-- Topbar -->
  <header class="topbar">
    <div class="search-wrap">
      <div class="search-wrap-inner">
        <i class="ti ti-search search-icon"></i>
        <input class="search-box" type="text" placeholder="Search...">
        <span class="search-hint">⌘ F</span>
      </div>
    </div>
    <div class="topbar-right">
      <div class="avatar">RS</div>
      <span class="user-name">Rahma Sephia</span>
    </div>
  </header>

  <!-- ════════ DASHBOARD PAGE ════════ -->
  <div class="page active" id="page-dashboard">
    <div class="page-header">
      <h1 class="page-title">Halo, Rahma Sephia 👋</h1>
      <p class="page-sub">Lihat pembaruan stok hari ini!</p>
    </div>

    <!-- Stat cards -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-label">Total Stok Masuk</div>
        <div class="stat-value-row">
          <span class="stat-value">75</span>
          <span class="stat-badge"><i class="ti ti-trending-up" style="font-size:11px"></i> +11%</span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Total Stok Keluar</div>
        <div class="stat-value-row">
          <span class="stat-value">71</span>
          <span class="stat-badge"><i class="ti ti-trending-up" style="font-size:11px"></i> +3%</span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Stok Terendah</div>
        <div class="stat-value-row">
          <span class="stat-value">1</span>
        </div>
        <div class="stat-meta">Ballerina Flat</div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Stok Tertinggi</div>
        <div class="stat-value-row">
          <span class="stat-value">38</span>
        </div>
        <div class="stat-meta">Loafers</div>
      </div>
    </div>

    <!-- Tabel Stok -->
    <div class="dashboard-grid">

    <!-- STOK MENIPIS -->

    <div class="card">

        <div class="card-header">
            <h3>Produk Stok Menipis (&lt; 10)</h3>
        </div>

        <div class="table-wrap">

            <table>

                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Stok</th>
                    </tr>
                </thead>

                <tbody id="lowStockTable">

                    <tr>
                        <td>B001</td>
                        <td>Lace Lynelle</td>
                        <td>4</td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

    <!-- STOK TERBANYAK -->
    <div class="card">
        <div class="card-header">
            <h3>Produk Stok Terbanyak</h3>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Stok</th>
                    </tr>
                </thead>

                <tbody id="highStockTable">
                    <tr>
                        <td>B012</td>
                        <td>Classic Loafers</td>
                        <td>120</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  </div>
    
  </div><!-- /dashboard -->

  <!-- ════════ PERSEDIAAN BARANG PAGE ════════ -->
  <div class="page" id="page-persediaan">

    <div class="page-header">
        <h1 class="page-title">Stok Ketersediaan Barang</h1>
        <p class="page-sub">
            Lihat dan validasi jumlah stok hari ini.
        </p>
    </div>

    <div class="inventory-tabs">
        <button class="tab-btn active" type="button" onclick="showInventoryTab('semua', this)">Semua</button>
        <button class="tab-btn" type="button" onclick="showInventoryTab('masuk', this)">Barang Masuk</button>
        <button class="tab-btn" type="button" onclick="showInventoryTab('keluar', this)">Barang Keluar</button>
        <button class="tab-btn" type="button" onclick="showInventoryTab('stok', this)">Stok Saat Ini</button>
    </div>


    <div class="table-wrap">
        <table>
            <thead>
                <tr id="inventoryTableHead">
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody id="inventoryTableBody">
                <!-- di-render oleh assets/js/app.js -->
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">
        <div class="rows-select">
            <span>Show</span>
            <select>
                <option>10</option>
            </select>
            <span>Row</span>
        </div>

        <div class="pagination">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">4</button>
            <button class="page-btn">5</button>
            <span>...</span>
            <button class="page-btn">10</button>
        </div>
    </div>

</div>

</div>

  <!-- Placeholder pages -->
  <div class="page" id="page-master">



    <!-- KATEGORI BARANG -->
    <div class="master-content active" id="master-kategori">

        <div class="page-header">
            <h1 class="page-title">
                Catatan Kelengkapan Kategori Barang
            </h1>

            <p class="page-sub">
                Lihat dan validasi stok barang tiap kategori.
            </p>
        </div>

        <div class="master-toolbar">

            <div class="inventory-tabs category-tabs" role="tablist" aria-label="Kategori Barang">
                <button class="tab-btn active" type="button">Flat Shoes</button>
                <button class="tab-btn" type="button">Ballet Flat</button>
                <button class="tab-btn" type="button">Loafers</button>
                <button class="tab-btn" type="button">Sandals / Slip-On</button>
                <button class="tab-btn" type="button">Heels</button>
            </div>

            <button class="btn-add"
                onclick="openModal('Tambah Kategori Barang')">
                + Tambah Data
            </button>

        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jenis Barang/Kategori</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Lace Lynelle</td>
                        <td>Flat Shoes</td>
                        <td>12</td>
                        <td>
                            <span class="status tersedia">
                                Tersedia
                            </span>
                        </td>

                        <td class="action-cell">

                            <button class="btn-action"
                                onclick="openModal('Edit Kategori')">
                                Edit
                            </button>

                            <button class="btn-action"
                                onclick="openDetail('Lace Lynelle')">
                                Detail
                            </button>

                            <button class="btn-delete"
                                onclick="openDelete('Lace Lynelle')">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- DAFTAR BARANG -->
    <div class="master-content" id="master-barang">

        <div class="page-header">
            <h1 class="page-title">
                Catatan Kelengkapan Daftar Barang
            </h1>
            <p class="page-sub">
                Lihat dan validasi stok barang tiap kategori.
            </p>
        </div>

        <div class="master-toolbar">
            <button class="filter-btn">
                Filter
            </button>

            <button class="btn-add"
                onclick="openModal('Tambah Barang')">
                + Tambah Data
            </button>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Tanggal Masuk</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Lace Lynelle</td>
                        <td>Flat Shoes</td>
                        <td>12 Mei 2026</td>
                        <td>12</td>
                        <td>
                            <span class="status pengiriman">
                                Dalam Pengiriman
                            </span>
                        </td>

                        <td class="action-cell">
                            <button class="btn-action">
                                Edit
                            </button>

                            <button class="btn-action">
                                Detail
                            </button>

                            <button class="btn-delete">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MANAJEMEN USER -->
    <div class="master-content" id="master-user">
        <div class="page-header">
            <h1 class="page-title">
                Manajemen Data Pengguna
            </h1>

            <p class="page-sub">
                Lihat dan kelola data pengguna.
            </p>
        </div>

        <div class="master-toolbar">
            <span class="role-chip">
                Admin
            </span>

            <button class="btn-add"
                onclick="openModal('Tambah Pengguna')">
                + Tambah Data
            </button>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pengguna</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Rahma Sephia Putri</td>
                        <td>sepnameia</td>
                        <td>sephia@mail.com</td>

                        <td>
                            <span class="status tersedia">
                                Aktif
                            </span>
                        </td>

                        <td class="action-cell">
                            <button class="btn-action">
                                Edit
                            </button>

                            <button class="btn-action">
                                Detail
                            </button>

                            <button class="btn-delete">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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

  <div class="page" id="page-laporan">
    <div class="page-header">
      <h1 class="page-title">Laporan</h1>
      <p class="page-sub">Ekspor dan analisa laporan stok.</p>
    </div>
    <div class="panel" style="color:var(--text-2); font-size:13px; text-align:center; padding: 60px 20px;">
      <i class="ti ti-file-analytics" style="font-size:36px; display:block; margin-bottom:10px; opacity:0.3"></i>
      Halaman Laporan — coming soon.
    </div>
  </div>

</div><!-- /main -->

<script src="{{ asset('assets/js/app.js') }}"></script>
</body>
</html>