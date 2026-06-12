<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - KerjainAja</title>
    
    {{-- Hubungan File Stylesheet Eksternal (Landing & Komponen Edit Profil) --}}
    <link rel="stylesheet" href="{{ asset('css/style_landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_edit_profil.css') }}">
</head>
<body>

    {{-- KONTAINER FORM UTAMA EDIT DATA PROFIL USER --}}
    <div class="edit-profile-container">
        <h2>Edit Profil</h2>

        {{-- Komponen Notifikasi Pesan Sukses Perubahan Data --}}
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- FORM 1: PEMBARUAN DATA DATA DAN FOTO PROFIL --}}
        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Komponen Unggah & Pratinjau (Preview) Foto Profil Baru --}}
            <div class="profile-image-section">
                <img id="preview" 
                     src="{{ asset('Images/profile/' . ($user->foto ?? 'default_profile.png')) }}" 
                     class="profile-preview">
                <br><br>
                <label for="foto_baru" class="btn-upload-label">Ganti Foto Profil</label>
                <input type="file" name="foto_baru" id="foto_baru" accept="image/*" 
                       style="display:none;" onchange="previewImage(event)">
            </div>

            {{-- Form Input: Identitas Nama Lengkap Pengguna --}}
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" 
                       value="{{ $user->nama }}" required>
            </div>

            {{-- Tombol Aksi Submit Form Pembaruan --}}
            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>

        <br>

        {{-- FORM 2: PENGHENTIAN STRUKTUR AKUN (HAPUS AKUN PERMANEN) --}}
        <form action="{{ route('profil.hapus') }}" method="POST"
              onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin menghapus akun? Semua data akan hilang permanen!')">
            @csrf
            @method('DELETE')
            <button type="submit" style="display:block; width:100%; text-align:center; color:red; background:none; border:none; font-weight:bold; cursor:pointer; margin-bottom:15px;">
                Hapus Akun Saya
            </button>
        </form>

        {{-- Tautan Alternatif Kembali Ke Halaman Beranda Utama --}}
        <a href="{{ route('home') }}" class="link-back">Kembali ke Beranda</a>
    </div>

    {{-- SCRIPT JAVASCRIPT: LOGIKA PRATINJAU GAMBAR SECARA REALTIME --}}
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    
</body>
</html>