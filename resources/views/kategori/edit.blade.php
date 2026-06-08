@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Edit Kategori Barang
        </h1>

        <p class="page-sub">
            Perbarui data kategori barang.
        </p>
    </div>

    <div class="card">

        <form method="POST"
              action="{{ route('kategori.update', $kategori->id) }}">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    class="form-input"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                    required>

                @error('nama_kategori')
                    <small style="color:red">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div style="
                display:flex;
                gap:10px;
                margin-top:24px;
            ">

                <button type="submit"
                        class="btn-add">
                    Simpan Perubahan
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