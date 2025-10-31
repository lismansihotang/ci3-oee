<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid py-3">
    <h4 class="mb-4 fw-bold text-uppercase">Manufacturing Dashboard</h4>

    <!-- Ringkasan Statistik -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-box-open fa-2x text-primary mb-2"></i>
                    <h6 class="text-muted mb-1">Purchase Orders</h6>
                    <h3 class="fw-bold">28</h3>
                    <p class="small text-muted mb-0">Belum diproses</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-file-signature fa-2x text-success mb-2"></i>
                    <h6 class="text-muted mb-1">SPK Aktif</h6>
                    <h3 class="fw-bold">14</h3>
                    <p class="small text-muted mb-0">Sedang berjalan</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-industry fa-2x text-warning mb-2"></i>
                    <h6 class="text-muted mb-1">Produksi Selesai</h6>
                    <h3 class="fw-bold">96%</h3>
                    <p class="small text-muted mb-0">Kinerja bulan ini</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-clipboard-check fa-2x text-danger mb-2"></i>
                    <h6 class="text-muted mb-1">QC Pending</h6>
                    <h3 class="fw-bold">5</h3>
                    <p class="small text-muted mb-0">Menunggu verifikasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row mt-3">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light fw-bold">Output Produksi Mingguan</div>
                <div class="card-body">
                    <canvas id="chartProduksi" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light fw-bold">Status Quality Control</div>
                <div class="card-body">
                    <canvas id="chartQC" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Grafik Produksi
    const ctx1 = document.getElementById('chartProduksi');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            datasets: [{
                label: 'Jumlah Produksi (unit)',
                data: [120, 150, 180, 170, 200, 130],
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Grafik QC
    const ctx2 = document.getElementById('chartQC');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Lulus QC', 'Hold', 'Reject'],
            datasets: [{
                data: [80, 10, 10],
                backgroundColor: ['#198754', '#ffc107', '#dc3545']
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
