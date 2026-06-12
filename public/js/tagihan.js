/* 9. EVENT KONFIRMASI PEMBAYARAN (FETCH API & SWEETALERT2) */

document.getElementById("btnKonfirmasi").addEventListener("click", function () {
    // Ambil ID pesanan dari URL (contoh: /tagihan/2 → id = 2)
    const id = window.location.pathname.split("/").pop();
    const csrfToken = document.querySelector(
        'meta[name="csrf-token"]',
    )?.content;

    // Mengirimkan request POST konfirmasi pembayaran ke server Laravel
    fetch(`/tagihan/${id}/konfirmasi`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
    })
        .then((res) => res.json())
        .then((data) => {
            // Menampilkan alert sukses jika server mengembalikan respons true
            if (data.success) {
                Swal.fire({
                    title: "Konfirmasi Berhasil!",
                    text: "Terima kasih! Pesanan Anda sedang kami verifikasi. Admin akan segera menghubungi Anda.",
                    icon: "success",
                    confirmButtonColor: "#114D4D",
                    confirmButtonText: "OK, Kembali ke Beranda",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/"; // Redirect ke halaman beranda
                    }
                });
            }
        })
        .catch(() => {
            // Menampilkan alert gagal jika terjadi gangguan koneksi atau error server
            Swal.fire({
                title: "Gagal!",
                text: "Terjadi kesalahan. Silakan coba lagi.",
                icon: "error",
                confirmButtonColor: "#e65c00",
            });
        });
});
