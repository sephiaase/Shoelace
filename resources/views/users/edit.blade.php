@extends('layouts.app')

@section('content')

<div class="page active">

    <div class="page-header">
        <h1 class="page-title">
            Edit Pengguna
        </h1>

        <p class="page-sub">
            Perbarui data pengguna.
        </p>
    </div>

    <div class="form-container">

        <form action="{{ route('user.update', $user->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Pengguna</label>

                <input type="text"
                       name="name"
                       class="form-input"
                       value="{{ $user->name }}"
                       required>
            </div>

            <div class="form-group">
                <label>Email</label>

                <input type="email"
                       name="email"
                       class="form-input"
                       value="{{ $user->email }}"
                       required>
            </div>

            <div class="form-actions">

                <button type="submit"
                        class="btn-add">
                    Simpan Perubahan
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