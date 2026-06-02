<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - {{ $nama_mitra }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style_chat.css') }}">
</head>
<body>

<div class="chat-container">

    <div class="chat-sidebar">
        <div class="sidebar-header">
            <a href="{{ route('detail', $id) }}" class="back-arrow">←</a>
            <h2>Chat</h2>
        </div>

        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Search messenger">
        </div>

        <div class="contact-list">
            <div class="contact-card active">
                <img src="{{ asset('Images/hero-img.png') }}" class="contact-avatar" alt="Profil">
                <div class="contact-info">
                    <h4 class="contact-name">{{ $nama_mitra }}</h4>
                    <p class="contact-msg">Tentu kak, bisa diinfokan...</p>
                </div>
                <span class="contact-time">09:05 AM</span>
            </div>

            <div class="contact-card inactive">
                <img src="{{ asset('Images/hero-img.png') }}" class="contact-avatar" alt="Profil Lain">
                <div class="contact-info">
                    <h4 class="contact-name">Budi Santoso</h4>
                    <p class="contact-msg">Terima kasih atas bantuannya.</p>
                </div>
                <span class="contact-time">Kemarin</span>
            </div>

            <div class="contact-card inactive">
                <img src="{{ asset('Images/hero-img.png') }}" class="contact-avatar" alt="Profil Lain">
                <div class="contact-info">
                    <h4 class="contact-name">Siti Aminah</h4>
                    <p class="contact-msg">Baik, saya tunggu kedatangannya.</p>
                </div>
                <span class="contact-time">Selasa</span>
            </div>
        </div>
    </div>

    <div class="chat-main">

        <div class="chat-header">
            <div class="header-user">
                <img src="{{ asset('Images/hero-img.png') }}" class="header-avatar" alt="Profil">
                <div class="header-name">
                    <h3>{{ $nama_mitra }}</h3>
                    <p class="header-status">Online</p>
                </div>
            </div>
            <div class="header-icons">
                <span>📞</span>
                <span>💬</span>
            </div>
        </div>

        <div class="chat-messages">
            <div class="date-badge">Hari Ini</div>

            <div class="message sent">
                <img src="{{ asset('Images/hero-img.png') }}" class="msg-avatar" alt="User">
                <div class="msg-bubble">Halo {{ $nama_mitra }}, saya melihat profil Anda di KerjainAja. Apakah Anda sedang menerima pesanan baru hari ini?</div>
            </div>

            <div class="message received">
                <img src="{{ asset('Images/hero-img.png') }}" class="msg-avatar" alt="Mitra">
                <div class="msg-bubble">Halo! Iya kak, saya masih available. Ada pekerjaan apa yang bisa saya bantu?</div>
            </div>

            <div class="message sent">
                <img src="{{ asset('Images/hero-img.png') }}" class="msg-avatar" alt="User">
                <div class="msg-bubble">Saya butuh bantuan sesuai dengan jasa yang ditawarkan di profil. Kira-kira estimasi harganya berapa ya?</div>
            </div>

            <div class="message received">
                <img src="{{ asset('Images/hero-img.png') }}" class="msg-avatar" alt="Mitra">
                <div class="msg-bubble">Tentu kak, bisa diinfokan lebih detail pekerjaannya?</div>
            </div>

            <div class="message sent">
                <img src="{{ asset('Images/hero-img.png') }}" class="msg-avatar" alt="User">
                <div class="msg-bubble">Baik, ini sesuai dengan budget saya. Saya mau pesan sekarang ya.</div>
            </div>

            <div class="action-area">
                <div class="action-text">Siap untuk melanjutkan pesanan?</div>
                <a href="{{ route('order', $id) }}" class="btn-pesan-sekarang">Pesan Sekarang</a>
            </div>
        </div>

        <div class="chat-input-container">
            <div class="chat-input-wrapper">
                <span class="icon-btn">➕</span>
                <span class="icon-btn">😀</span>
                <input type="text" class="chat-input" placeholder="Ketik Pesan">
                <span class="icon-btn">🎤</span>
            </div>
        </div>

    </div>

</div>

</body>
</html>