@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Tambah Data Barang
        </h1>

        <p class="page-sub">
            Tambahkan produk baru ke dalam sistem.
        </p>
    </div>

    <div class="card">
        @if ($errors->any())

        <div class="alert-error">

            <ul>

                @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif
        
        <form method="POST"
            action="{{ route('barang.store') }}">

            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label">
                        Kode Barang
                    </label>

                    <input
                        type="text"
                        name="kode_barang"
                        class="form-input"
                        value="{{ old('kode_barang') }}"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Nama Barang
                    </label>

                    <input
                        type="text"
                        name="nama_barang"
                        class="form-input"
                        value="{{ old('nama_barang') }}"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Kategori Barang
                    </label>

                    <select
                        name="kategori_barang_id"
                        class="form-input"
                        required>

                        <option value="">
                            Pilih Kategori
                        </option>

                        @foreach($kategoris as $kategori)

                        <option
                            value="{{ $kategori->id }}"
                            {{ old('kategori_barang_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>

                        @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Harga
                    </label>

                    <input
                        type="number"
                        name="harga"
                        class="form-input"
                        value="{{ old('harga') }}"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Stok Awal
                    </label>

                    <input
                        type="number"
                        name="stok"
                        class="form-input"
                        value="{{ old('stok') }}"
                        required>
                </div>

            </div>

            <div class="form-actions">

                <button type="submit"
                    class="btn-add">
                    Simpan Barang
                </button>

                <a href="{{ route('barang.index') }}"
                    class="btn-action">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection