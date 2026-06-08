@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Tambah Pengguna
        </h1>

        <p class="page-sub">
            Tambahkan pengguna baru ke dalam sistem.
        </p>
    </div>

    <div class="form-container">

        <form action="{{ route('user.store') }}"
              method="POST">

            @csrf

            <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text"
                       name="name"
                       class="form-input"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-input"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password"
                       name="password"
                       class="form-input"
                       required>
            </div>

            <div class="form-actions">

                <button type="submit"
                        class="btn-add">
                    Simpan
                </button>

                <a href="{{ route('user.index') }}"
                   class="btn-action">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection