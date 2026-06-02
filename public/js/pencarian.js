// FITUR DETEKSI LOKASI
const lokasiTeks = document.getElementById("lokasi-user");

function dapatkanLokasi() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(tampilkanPosisi, tampilkanError);
  } else {
    if (lokasiTeks)
      lokasiTeks.innerHTML = "📍 Browser kamu tidak mendukung fitur lokasi.";
  }
}

function tampilkanPosisi(position) {
  let lat = position.coords.latitude;
  let lon = position.coords.longitude;

  fetch(
    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`,
  )
    .then((response) => response.json())
    .then((data) => {
      let kota =
        data.address.city ||
        data.address.town ||
        data.address.county ||
        "Lokasi ditemukan";
      if (lokasiTeks) lokasiTeks.innerHTML = "📍 Lokasi kamu: " + kota;
    })
    .catch(() => {
      if (lokasiTeks) lokasiTeks.innerHTML = `📍 Koordinat: ${lat}, ${lon}`;
    });
}

function tampilkanError(error) {
  if (!lokasiTeks) return;
  switch (error.code) {
    case error.PERMISSION_DENIED:
      lokasiTeks.innerHTML = "📍 Akses lokasi ditolak oleh pengguna.";
      break;
    case error.POSITION_UNAVAILABLE:
      lokasiTeks.innerHTML = "📍 Informasi lokasi tidak tersedia.";
      break;
    case error.TIMEOUT:
      lokasiTeks.innerHTML = "📍 Waktu pencarian lokasi habis.";
      break;
  }
}

window.onload = dapatkanLokasi;

// FITUR FILTER WILAYAH (SYARAT ETS JAVASCRIPT)

const filterSelect = document.getElementById("filter-wilayah");
const semuaKartu = document.querySelectorAll(".card");

if (filterSelect) {
  filterSelect.addEventListener("change", function () {
    const wilayahPilihan = this.value;

    semuaKartu.forEach((kartu) => {
      const wilayahKartu = kartu.getAttribute("data-wilayah");

      if (wilayahPilihan === "semua" || wilayahPilihan === wilayahKartu) {
        kartu.style.display = "block"; // Munculkan
      } else {
        kartu.style.display = "none"; // Sembunyikan
      }
    });
  });
}
