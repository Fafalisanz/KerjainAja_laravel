<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - KerjainAja</title>
    <link rel="stylesheet" href="{{ asset('css/style_landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style_edit_profil.css') }}">
</head>
<body>
    <div class="edit-profile-container">
        <h2>Edit Profil</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="profile-image-section">
                <img id="preview" 
                     src="{{ asset('Images/profile/' . ($user->foto ?? 'default_profile.png')) }}" 
                     class="profile-preview">
                <br><br>
                <label for="foto_baru" class="btn-upload-label">Ganti Foto Profil</label>
                <input type="file" name="foto_baru" id="foto_baru" accept="image/*" 
                       style="display:none;" onchange="previewImage(event)">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" 
                       value="{{ $user->nama }}" required>
            </div>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </form>

        <br>

        {{-- Hapus Akun --}}
        <form action="{{ route('profil.hapus') }}" method="POST"
              onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin menghapus akun? Semua data akan hilang permanen!')">
            @csrf
            @method('DELETE')
            <button type="submit" style="display:block; width:100%; text-align:center; 
                    color:red; background:none; border:none; font-weight:bold; 
                    cursor:pointer; margin-bottom:15px;">
                Hapus Akun Saya
            </button>
        </form>

        <a href="{{ route('home') }}" class="link-back">Kembali ke Beranda</a>
    </div>

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