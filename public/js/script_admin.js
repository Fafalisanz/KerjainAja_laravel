new Chart(document.getElementById("grafikPesanan"), {
    type: "line",
    data: {
        labels: labels,
        datasets: [
            {
                label: "Jumlah Pesanan",
                data: data,
                borderColor: "#e65c00",
                backgroundColor: "rgba(230,92,0,0.1)",
                tension: 0.4,
                fill: true,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 },
            },
        },
    },
});
