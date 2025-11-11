document.addEventListener("DOMContentLoaded", function () {
    // ===== Alert Login Berhasil =====
    const alertBox = document.getElementById("successAlert");
    if (alertBox) {
        alertBox.classList.add("show");
        setTimeout(() => {
            alertBox.classList.remove("show");
        }, 3000);
    }

    // ===== Grafik Pendapatan =====
    const ctx = document.getElementById('chartPendapatan');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: [12000000, 15000000, 13000000, 17000000, 20000000, 18000000, 21000000],
                    backgroundColor: ['#27ae60', '#2ecc71', '#27ae60', '#2ecc71', '#27ae60', '#2ecc71', '#27ae60'],
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }
});
