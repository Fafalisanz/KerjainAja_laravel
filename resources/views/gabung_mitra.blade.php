<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabung Mitra - KerjainAja</title>
    <link rel="stylesheet" href="{{ asset('css/style_mitra.css') }}">
</head>
<body>
    <div style="text-align:center; color:white; margin-bottom:20px; z-index:10; position:relative;">
        <h1 style="margin-bottom:5px;">Ayo Beraksi Bersama KerjainAja!</h1>
        <p style="margin-top:0; font-size:14px;">Bergabunglah dengan ribuan mitra pahlawan lainnya.<br>Tentukan sendiri jam kerjamu dan bantu sesama.</p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:15px; border-radius:8px; margin-bottom:20px; text-align:center;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('mitra.proses') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div id="step1" class="form-step active">
            <h2>Data Diri</h2>

            <label>Nama Lengkap (Sesuai KTP):</label>
            <input type="text" name="nama_lengkap" required>
            @error('nama_lengkap')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <label>Nomor WhatsApp Aktif:</label>
            <input type="text" name="no_wa" required>
            @error('no_wa')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <label>Kota / Domisili:</label>
            <input type="text" name="kota" required>
            @error('kota')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <label>Keahlian:</label>
            <textarea name="keahlian" required></textarea>
            @error('keahlian')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <div class="btn-group">
                <button type="button" class="btn-next" 
                        onclick="nextStep('step2', 'step1')">Next</button>
            </div>
        </div>

        <div id="step2" class="form-step">
            <h2>Unggah Foto KTP Asli</h2>
            <input type="file" name="foto_ktp" accept="image/*" required>
            @error('foto_ktp')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <div class="btn-group">
                <button type="button" class="btn-prev" 
                        onclick="prevStep('step1', 'step2')">Kembali</button>
                <button type="button" class="btn-next" 
                        onclick="nextStep('step3', 'step2')">Next</button>
            </div>
        </div>

        <div id="step3" class="form-step">
            <h2>Foto Selfie dengan KTP</h2>
            <input type="file" name="foto_selfie" accept="image/*" required>
            @error('foto_selfie')
                <span class="error-text">{{ $message }}</span>
            @enderror

            <div class="btn-group">
                <button type="button" class="btn-prev" 
                        onclick="prevStep('step2', 'step3')">Kembali</button>
                <button type="submit" class="btn-submit">Submit</button>
            </div>
        </div>
    </form>

    <img src="{{ asset('Images/mascot-search-kiri.png') }}" 
         class="maskot-form" alt="Maskot Hero">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                title: 'Pendaftaran Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success'
            }).then(function() {
                window.location.href = '/';
            });
        </script>
    @endif

        <label>Email:</label>
        <input type="email" name="email" required>
        @error('email')
            <span class="error-text">{{ $message }}</span>
        @enderror

        <label>Password:</label>
        <input type="password" name="password" required>
        @error('password')
            <span class="error-text">{{ $message }}</span>
        @enderror

    <script src="{{ asset('js/script_mitra.js') }}"></script>
</body>
</html>