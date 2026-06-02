<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - KerjainAja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_auth.css') }}">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-left">
            <img src="{{ asset('Images/logo.png') }}" alt="Ilustrasi Masuk" class="auth-img">
            <h2>Selamat Datang Kembali!</h2>
            <p>Senang melihatmu lagi. Yuk, selesaikan pekerjaanmu hari ini bersama KerjainAja.</p>
        </div>

        <div class="auth-right">
            <div class="auth-form-container">
                <div class="auth-header">
                    <a href="{{ route('home') }}" class="back-link">&larr; Kembali ke Beranda</a>
                    <h2>Masuk ke Akun Anda</h2>
                </div>

                @if(session('error'))
                    <div class="alert-error">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login.proses') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" 
                               value="{{ old('email') }}"
                               placeholder="Masukkan email Anda" required>
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <label for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" 
                               placeholder="Masukkan kata sandi" required>
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-options">
                        <a href="#" class="forgot-password">Lupa Kata Sandi?</a>
                    </div>

                    <button type="submit" class="btn-primary">Masuk</button>
                </form>

                <p class="auth-footer">Belum punya akun? <a href="{{ route('daftar') }}">Daftar</a></p>
            </div>
        </div>
    </div>
</body>
</html>