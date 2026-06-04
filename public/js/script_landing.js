// --- FITUR PENCARIAN ---
const searchInput = document.getElementById("searchInput");

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

// --- DATA JAWABAN FAQ ---
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

// --- FUNGSI MENGUBAH JAWABAN, WARNA TOMBOL, & ANIMASI MASKOT ---
function showAnswer(faqId, clickedElement) {
    // 1. Ubah teks judul dan deskripsi
    document.getElementById("answer-title").innerText = faqData[faqId].title;
    document.getElementById("answer-desc").innerText = faqData[faqId].desc;

    // 2. MENGHAPUS WARNA HIJAU DARI SEMUA TOMBOL
    const semuaTombol = document.querySelectorAll(".faq-btn");
    semuaTombol.forEach((btn) => btn.classList.remove("active"));

    // 3. MEMBERIKAN WARNA HIJAU KE TOMBOL YANG DIKLIK
    clickedElement.classList.add("active");

    // 4. ANIMASI MASKOT LOMPAT
    const mascot = document.querySelector(".faq-mascot");
    if (mascot) {
        mascot.style.transform = "translateY(-10px) rotate(-5deg)"; // Efek lompat
        setTimeout(() => {
            mascot.style.transform = "translateY(0) rotate(0deg)"; // Kembali normal
        }, 300);
    } // <--- PERHATIKAN INI ADALAH PENUTUP DARI FUNGSI SHOW ANSWER
}

// =======================================================
// FITUR FILTER KATEGORI (DARI DATABASE) - BERDIRI SENDIRI
// =======================================================
function jalankanFilter(event, kategori) {
    event.preventDefault();

    // 1. Ubah warna tombol
    let buttons = document.querySelectorAll(".btn-filter");
    buttons.forEach((btn) => btn.classList.remove("active"));
    event.currentTarget.classList.add("active");

    // 2. Filter kartunya dengan animasi
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

// Dropdown Profil

function toggleDropdown() {
    document.getElementById("profilMenu").classList.toggle("show");
}

document.addEventListener("click", function (e) {
    const dropdown = document.querySelector(".profile-dropdown");
    if (dropdown && !dropdown.contains(e.target)) {
        document.getElementById("profilMenu").classList.remove("show");
    }
});
