<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Shoelace</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('assets/css/login.css') }}">
</head>

<body>

    <div class="login-container">

        <div class="login-image">

            <img src="{{ asset('assets/images/login-shoe.jpg') }}"
                alt="Shoelace">

        </div>

        <div class="login-form-area">

            <div class="login-box">

                <div class="brand-mark">
                    SHOELACE
                </div>

                <h1>
                    Selamat Datang Kembali!
                </h1>

                <p>
                    Masukan data Anda untuk mengakses web.
                </p>

                @if(session('error'))
                <div class="error-box">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST"
                    action="{{ route('login.process') }}">

                    @csrf

                    <label>Email</label>

                    <input type="email"
                        name="email"
                        placeholder="Masukkan email">

                    <label>Password</label>

                    <input type="password"
                        name="password"
                        placeholder="Masukkan password">

                    <button type="submit">
                        Masuk
                    </button>

                </form>

            </div>

        </div>

    </div>

</body>

</html>