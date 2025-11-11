document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('revenueChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Pendapatan 2025',
                data: [12000, 19000, 3000, 5000, 20000, 30000],
                backgroundColor: '#6fa36f'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
