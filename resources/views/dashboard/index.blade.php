@extends('layouts.app')

@section('content')

  <div class="page active">
    <div class="page-header">
      <h1 class="page-title">Halo, Rahma Sephia 👋</h1>
      <p class="page-sub">Lihat pembaruan stok hari ini!</p>
    </div>

    <!-- Stat cards -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-label">Total Barang</div>
        <div class="stat-value-row">
          <span class="stat-value">{{ $totalBarang }}</span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Total Stok Masuk</div>
        <div class="stat-value-row">
          <span class="stat-value">{{ $totalMasuk }}</span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Total Stok Keluar</div>
        <div class="stat-value-row">
          <span class="stat-value">{{ $totalKeluar }}</span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Stok Terendah</div>
        <div class="stat-value-row">
          <span class="stat-value">{{ $stokTerendah->stok ?? 0 }}</span>
        </div>
        <div class="stat-meta">{{ $stokTerendah->nama_barang ?? '-' }}</div>
      </div>
    </div>

    <!-- Tabel Stok -->
    <div class="dashboard-grid">

    <!-- Stok Sedikit -->
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

                <tbody>

                @foreach($stokMenipis as $barang)

                <tr>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->stok }}</td>
                </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Stok Terbanyak -->
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

                <tbody>

                @foreach($stokTerbanyak as $barang)

                <tr>
                    <td>{{ $barang->kode_barang }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->stok }}</td>
                </tr>

                @endforeach

                </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection