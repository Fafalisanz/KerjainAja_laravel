/* 4. FITUR PENCARIAN UTAMA (REDIRECT BROWSER) */
const searchInput = document.getElementById("searchInput");

if (searchInput) {
    searchInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            const keyword = searchInput.value;
            if (keyword.trim() !== "") {
                window.location.href =
                    "/pencarian?keyword=" + encodeURIComponent(keyword);
            } else {
                alert("Silakan ketik jasa yang Anda cari terlebih dahulu!");
            }
        }
    });
}

/* 5. DATA DAN FUNGSI INTERAKTIF KOMPONEN FAQ ACCORDION */
const faqData = {
    faq1: {
        title: "Apa itu KerjainAja?",
        desc: "KerjainAja adalah platform yang menghubungkan pencari jasa dengan pekerja lokal (mitra) untuk menyelesaikan berbagai tugas sehari-hari. Mulai dari kurir mendadak, teknisi, tenaga kebersihan, hingga bantuan lain yang bersifat fleksibel dan cepat.",
    },
    faq2: {
        title: "Apakah aman menggunakan jasa KerjainAja?",
        desc: "Sangat aman. Setiap mitra kami telah melewati proses verifikasi identitas dan latar belakang yang ketat. Selain itu, kami juga menyediakan sistem rating dan ulasan untuk memastikan kualitas layanan tetap terjaga.",
    },
    faq3: {
        title: "Bagaimana cara pembayaran jasanya?",
        desc: "Pembayaran dapat dilakukan secara tunai langsung kepada mitra, atau menggunakan dompet digital (e-wallet) maupun transfer bank yang terintegrasi langsung di dalam sistem aplikasi KerjainAja.",
    },
    faq4: {
        title: "Bagaimana cara mendaftar sebagai pekerja/mitra?",
        desc: 'Anda dapat menekan tombol "Gabung Jadi Mitra" di halaman utama, lalu mengisi formulir pendaftaran yang berisi data diri, jenis keahlian, dan dokumen identitas. Tim kami akan segera memproses pendaftaran Anda.',
    },
    faq5: {
        title: "Apakah ada asuransi atau garansi jika terjadi masalah?",
        desc: "Ya, kami menyediakan perlindungan asuransi dasar untuk tugas-tugas tertentu. Jika terjadi kelalaian atau kerusakan barang, Anda dapat melaporkannya melalui pusat bantuan kami untuk proses investigasi dan garansi.",
    },
    faq6: {
        title: "Bagaimana jika pekerja tidak datang atau terlambat?",
        desc: "Jika pekerja terlambat parah atau tidak datang, Anda dapat membatalkan pesanan tanpa biaya tambahan. Sistem kami akan langsung mencarikan mitra pengganti terdekat. Mitra yang melanggar komitmen akan diberikan sanksi.",
    },
};

// Mengubah teks deskripsi jawaban, warna tombol aktif, dan mentrigger animasi maskot
function showAnswer(faqId, clickedElement) {
    // 1. Ubah teks judul dan deskripsi
    document.getElementById("answer-title").innerText = faqData[faqId].title;
    document.getElementById("answer-desc").innerText = faqData[faqId].desc;

    // 2. Menghapus warna hijau aktif dari semua tombol FAQ
    const semuaTombol = document.querySelectorAll(".faq-btn");
    semuaTombol.forEach((btn) => btn.classList.remove("active"));

    // 3. Memberikan warna hijau aktif ke tombol yang diklik oleh user
    clickedElement.classList.add("active");

    // 4. Animasi maskot melompat kecil
    const mascot = document.querySelector(".faq-mascot");
    if (mascot) {
        mascot.style.transform = "translateY(-10px) rotate(-5deg)"; // Efek lompat ke atas
        setTimeout(() => {
            mascot.style.transform = "translateY(0) rotate(0deg)"; // Kembali ke posisi semula
        }, 300);
    }
}

/* 6. FITUR FILTER KATEGORI FREELANCER (MANIPULASI ANIMASI DOM) */
function jalankanFilter(event, kategori) {
    event.preventDefault();

    // 1. Ubah warna tombol filter aktif
    let buttons = document.querySelectorAll(".btn-filter");
    buttons.forEach((btn) => btn.classList.remove("active"));
    event.currentTarget.classList.add("active");

    // 2. Filter tampilan kartu dengan injeksi keyframe CSS animasi
    let cards = document.querySelectorAll(".freelance-card");
    cards.forEach((card) => {
        if (
            kategori === "semua" ||
            card.getAttribute("data-kategori") === kategori
        ) {
            card.style.display = "block";
            card.style.animation = "fadeInCard 0.4s ease forwards";
        } else {
            card.style.display = "none";
        }
    });
}

/* 7. EVENT TOGGLE DROPDOWN MENU PROFIL */
function toggleDropdown() {
    document.getElementById("profilMenu").classList.toggle("show");
}

// Menutup menu dropdown secara otomatis jika pengguna mengklik area luar menu profil
document.addEventListener("click", function (e) {
    const dropdown = document.querySelector(".profile-dropdown");
    const profilMenu = document.getElementById("profilMenu");

    if (dropdown && profilMenu && !dropdown.contains(e.target)) {
        profilMenu.classList.remove("show");
    }
});
