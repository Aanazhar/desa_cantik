<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Admin - Desa Cantik</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/style.css') }}"
    >

</head>

<body>

<div class="admin-login-page">

    <div class="admin-login-card">

        <div class="admin-login-logo">
            DC
        </div>

        <h1>
            Admin Desa Cantik
        </h1>

        <p class="admin-login-description">
            Silakan login untuk mengelola website desa.
        </p>


        @if(session('success'))

            <div class="admin-alert admin-alert-success">
                {{ session('success') }}
            </div>

        @endif


        @if(session('error'))

            <div class="admin-alert admin-alert-error">
                {{ session('error') }}
            </div>

        @endif


        @if($errors->any())

            <div class="admin-alert admin-alert-error">
                {{ $errors->first() }}
            </div>

        @endif


        <form
            method="POST"
            action="{{ route('admin.login.submit') }}"
        >

            @csrf


            <div class="admin-form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@desacantik.id"
                    required
                >

            </div>


            <div class="admin-form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>


            <button
                type="submit"
                class="admin-btn-primary"
            >
                Login ke Dashboard
            </button>

        </form>


        <a
            href="{{ route('home') }}"
            class="admin-back"
        >
            ← Kembali ke Website
        </a>

    </div>

</div>

</body>

</html>
```
