// Isi file: assets/js/tagihan.js

document.getElementById("btnKonfirmasi").addEventListener("click", function () {
  Swal.fire({
    title: "Konfirmasi Berhasil!",
    text: "Terima kasih! Pesanan Anda sedang kami verifikasi. Admin akan segera menghubungi Anda.",
    icon: "success",
    confirmButtonColor: "#114D4D",
    confirmButtonText: "OK, Kembali ke Beranda",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "index.php";
    }
  });
});
