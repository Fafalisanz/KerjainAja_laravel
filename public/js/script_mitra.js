/* 8. FITUR NAVIGASI MULTI-STEP FORM (FORWARD & BACKWARD) */

// Fungsi untuk melangkah ke tahapan pengisian form berikutnya
function nextStep(nextId, currentId) {
    document.getElementById(currentId).classList.remove("active");
    document.getElementById(nextId).classList.add("active");
}

// Fungsi untuk kembali ke tahapan pengisian form sebelumnya
function prevStep(prevId, currentId) {
    document.getElementById(currentId).classList.remove("active");
    document.getElementById(prevId).classList.add("active");
}
