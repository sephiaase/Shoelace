@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Edit Data Barang
        </h1>

        <p class="page-sub">
            Perbarui informasi barang.
        </p>
    </div>

    <div class="card">

        <form method="POST"
              action="{{ route('barang.update', $barang->id) }}">

            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label class="form-label">
                        Kode Barang
                    </label>

                    <input
                        type="text"
                        name="kode_barang"
                        class="form-input"
                        value="{{ old('kode_barang', $barang->kode_barang) }}"
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
                        value="{{ old('nama_barang', $barang->nama_barang) }}"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Kategori
                    </label>

                    <select
                        name="kategori_barang_id"
                        class="form-input"
                        required>

                        @foreach($kategoris as $kategori)

                            <option
                                value="{{ $kategori->id }}"
                                {{ $barang->kategori_barang_id == $kategori->id ? 'selected' : '' }}>
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
                        value="{{ old('harga', $barang->harga) }}"
                        required>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        class="form-input"
                        value="{{ old('stok', $barang->stok) }}"
                        required>
                </div>

            </div>

            <div class="form-actions">

                <button type="submit"
                        class="btn-add">
                    Simpan Perubahan
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