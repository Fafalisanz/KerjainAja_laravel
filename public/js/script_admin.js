/* 3. KONFIGURASI GRAFIK PESANAN (CHART.JS INTERFACE) */
new Chart(document.getElementById("grafikPesanan"), {
    type: "line", // Menentukan tipe grafik berupa garis (line chart)
    data: {
        labels: labels, // Menampung array data tanggal/hari pada sumbu X
        datasets: [
            {
                label: "Jumlah Pesanan",
                data: data, // Menampung array angka total pesanan pada sumbu Y
                borderColor: "#e65c00", // Warna garis grafik (orange khas aplikasi)
                backgroundColor: "rgba(230,92,0,0.1)", // Warna latar area di bawah garis
                tension: 0.4, // Membuat garis grafik melengkung halus (smooth line)
                fill: true, // Mengaktifkan efek warna background di bawah garis
            },
        ],
    },
    options: {
        responsive: true, // Membuat ukuran grafik otomatis menyesuaikan lebar layar (fleksibel)
        plugins: {
            legend: {
                display: false, // Menyembunyikan kotak label penanda dataset di atas grafik
            },
        },
        scales: {
            y: {
                beginAtZero: true, // Memaksa grafik selalu memulai angka sumbu Y dari angka 0
                ticks: {
                    stepSize: 1, // Mengatur jarak kelipatan angka pada sumbu Y sebesar 1 poin
                },
            },
        },
    },
});
