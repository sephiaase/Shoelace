@extends('layouts.app')

@section('content')

<div class="page active">

<div class="page-header">
    <h1 class="page-title">
        Tambah Kategori Barang
    </h1>

    <p class="page-sub">
        Tambahkan kategori baru untuk mengelompokkan data barang.
    </p>
</div>

<div class="card form-card">

    <form action="{{ route('kategori.store') }}"
          method="POST">

        @csrf

        <div class="form-group">

            <label class="form-label">
                Nama Kategori
            </label>

            <input type="text"
                   name="nama_kategori"
                   class="form-control"
                   placeholder="Contoh: Flat Shoes"
                   value="{{ old('nama_kategori') }}"
                   required>

            @error('nama_kategori')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror

        </div>

        <div class="form-actions">

            <button type="submit"
                    class="btn-add">
                Simpan Kategori
            </button>

            <a href="{{ route('kategori.index') }}"
               class="btn-action">
                Kembali
            </a>

        </div>

    </form>

</div>

</div>

@endsection
