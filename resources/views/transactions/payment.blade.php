<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background: #f5f5f5;">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">

    <div class="card shadow-lg p-4" style="background-color: #C0EBA6; width: 420px; border-radius: 15px;">

        <h4 class="text-center fw-bold mb-3">Pembayaran</h4>

        {{-- GRAND TOTAL --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Grand Total</label>
            <input type="text" class="form-control" value="Rp {{ number_format($total,0,',','.') }}" readonly>
        </div>

        {{-- METODE PEMBAYARAN --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Metode Pembayaran</label>
            <select id="metodePembayaran" class="form-select">
                <option value="cash">Cash</option>
                <option value="qris">QRIS</option>
                <option value="cashless">Cashless</option>
            </select>
        </div>

        {{-- CASH --}}
        <div id="cashSection" class="mt-2">
            <label class="fw-bold">Bayar</label>
            <input type="number" id="bayar" class="form-control mb-2">

            <label class="fw-bold">Kembalian</label>
            <input type="text" id="kembalian" class="form-control" readonly>
        </div>

        {{-- QRIS --}}
        <div id="qrisSection" class="text-center mt-3" style="display: none;">
            <p class="fw-bold mb-1">Scan QRIS</p>
            <img src="/images/qris_sample.png" 
                 style="width: 230px; height: 230px; border-radius: 12px;">
        </div>

        {{-- CASHLESS --}}
        <div id="cashlessSection" class="mt-3" style="display: none;">
            <label class="fw-bold">Pilih E-Wallet</label>
            <select class="form-select">
                <option value="ovo">OVO</option>
                <option value="dana">DANA</option>
                <option value="gopay">Gopay</option>
            </select>

            <div class="text-center mt-3">
                <img src="/images/ewallet_qr.png" 
                     style="width: 200px; height: 200px; border-radius: 10px;">
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="d-flex justify-content-between mt-4">

            <a href="{{ route('transactions.index') }}" 
               class="btn btn-danger text-white fw-semibold px-4">
                Batal
            </a>

            <form method="POST" action="{{ route('payments.process') }}">
                @csrf
                <input type="hidden" name="total" value="{{ $total }}">
                <button class="btn btn-warning fw-bold text-dark px-4">
                    Bayar
                </button>
            </form>

        </div>

    </div>

</div>


<script>
    const metode = document.getElementById("metodePembayaran");
    const cash = document.getElementById("cashSection");
    const qris = document.getElementById("qrisSection");
    const cashless = document.getElementById("cashlessSection");

    metode.addEventListener("change", () => {
        if (metode.value === "cash") {
            cash.style.display = "block";
            qris.style.display = "none";
            cashless.style.display = "none";
        } 
        else if (metode.value === "qris") {
            cash.style.display = "none";
            qris.style.display = "block";
            cashless.style.display = "none";
        }
        else {
            cash.style.display = "none";
            qris.style.display = "none";
            cashless.style.display = "block";
        }
    });

    // Hitung kembalian otomatis
    document.getElementById("bayar").addEventListener("input", function () {
        let bayar = parseFloat(this.value || 0);
        let total = {{ $total }};
        let kembali = bayar - total;
        document.getElementById("kembalian").value = kembali >= 0 ? kembali : 0;
    });
</script>

</body>
</html>
