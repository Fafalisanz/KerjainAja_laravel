<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - KerjainAja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_auth.css') }}">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-left">
            <img src="{{ asset('Images/logo.png') }}" alt="Ilustrasi Daftar" class="auth-img">
            <h2>Gabung dengan Kami!</h2>
            <p>Jadilah bagian dari komunitas KerjainAja dan temukan kemudahan dalam setiap pekerjaanmu.</p>
        </div>

        <div class="auth-right">
            <div class="auth-form-container">
                <div class="auth-header">
                    <a href="{{ route('home') }}" class="back-link">&larr; Kembali ke Beranda</a>
                    <h2>Buat Akun Baru</h2>
                </div>

                @if(session('error'))
                    <div class="alert-error">{{ session('error') }}</div>
                @endif

                <form action="{{ route('daftar.proses') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" 
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama lengkap" required>
                        @error('nama')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
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
                               placeholder="Buat kata sandi baru" required>
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <input type="password" id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Ulangi kata sandi" required>
                    </div>

                    <button type="submit" class="btn-primary">Daftar</button>
                </form>

                <p class="auth-footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
            </div>
        </div>
    </div>
</body>
</html>