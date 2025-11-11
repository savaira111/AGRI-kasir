<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - AGRI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Rubik', sans-serif; background-color: #f4f7f4;">

<div class="d-flex">

    <!-- 🌿 SIDEBAR -->
    <div class="d-flex flex-column justify-content-between"
         style="width: 250px; height: 100vh; background-color: #C0EBA6; padding: 30px 20px; color: black;">
        
        <div>
            <div class="text-center mb-5">
                <img src="{{ asset('images/logo-kasir.png') }}" alt="Logo" 
                     style="width: 70px; height: 70px; border-radius: 50%;">
                <h4 class="mt-2 fw-bold">AGRI</h4>
            </div>

            <ul class="list-unstyled mt-5">
                <li class="mb-3">
                    <a href="#" class="d-block text-black text-decoration-none p-2 rounded fw-bold" 
                       style="background-color: #FCCD2A;">
                       <i class="bi bi-box-seam me-2"></i> Kelola produk
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                       onmouseover="this.style.backgroundColor='#FCCD2A';"
                       onmouseout="this.style.backgroundColor='transparent';">
                       <i class="bi bi-people-fill me-2"></i> Kelola User
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                       onmouseover="this.style.backgroundColor='#FCCD2A';"
                       onmouseout="this.style.backgroundColor='transparent';">
                       <i class="bi bi-cart-check-fill me-2"></i> Transaksi Penjualan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                       onmouseover="this.style.backgroundColor='#FCCD2A';"
                       onmouseout="this.style.backgroundColor='transparent';">
                       <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="mb-3">
                    <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                       onmouseover="this.style.backgroundColor='#FCCD2A';"
                       onmouseout="this.style.backgroundColor='transparent';">
                       <i class="bi bi-bar-chart-line-fill me-2"></i> Laporan Penjualan
                    </a>
                </li>
            </ul>
        </div>

        <div class="text-center mb-3" style="color: gray; font-size: 0.9rem;">
            <i class=""></i> Kelola Produk
        </div>
    </div>
    <!-- 🌿 END SIDEBAR -->


    <!-- MAIN CONTENT -->
    <div class="flex-grow-1 p-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center p-4 rounded"
             style="background-color: #B9E4C9;">
            <h4 class="fw-bold">Kelola Produk Owner</h4>
            <div>
                <input type="text" class="form-control d-inline-block" placeholder="Cari produk..."
                       style="width: 250px; display: inline;">
                <button class="btn btn-warning ms-2 fw-bold text-white" style="background-color:#FCCD2A;">
                    <i class="bi bi-plus-circle me-1"></i> Tambah
                </button>
            </div>
        </div>

        <!-- Tabel Produk -->
        <div class="mt-4 bg-light p-3 rounded shadow-sm">
            <table class="table table-bordered text-center align-middle" style="background-color: #C0EBA6;">
                <thead>
                    <tr style="background-color: #A0D683; color: #000;">
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Nama Pemasok</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody style="background-color: #D3F8C8;">
                    <tr>
                        <td>1</td>
                        <td>43673098122874</td>
                        <td>Pupuk Media Tanam</td>
                        <td>Jamal</td>
                        <td>Pupuk</td>
                        <td>25</td>
                        <td>
                            <button class="btn btn-sm btn-outline-success me-1"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-sm btn-outline-danger me-1"><i class="bi bi-trash"></i></button>
                            <button class="btn btn-sm btn-outline-warning"><i class="bi bi-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS sederhana -->
<script>
    document.querySelector('.btn-warning').addEventListener('click', () => {
        alert('Fitur tambah produk belum diaktifkan 🌱');
    });
</script>

</body>
</html>
