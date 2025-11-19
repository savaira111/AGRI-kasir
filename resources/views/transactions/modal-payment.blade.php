<style>
    .modal-pembayaran-bg {
        background: #c6f4b1;
        border-radius: 15px;
        padding: 30px 40px;
    }

    .form-mini {
        width: 160px;
        height: 34px;
        font-size: 13px;
        padding: 3px 8px;
    }

    .label-text {
        font-weight: 600;
        font-size: 14px;
    }

    .btn-batal {
        background: #c62828;
        color: white;
        padding: 8px 35px;
        border-radius: 20px;
        font-weight: bold;
        border: none;
    }

    .btn-bayar {
        background: #ffcb05;
        color: black;
        padding: 8px 35px;
        border-radius: 20px;
        font-weight: bold;
        border: none;
    }

    .payment-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
</style>

<!-- ======================= MODAL PEMBAYARAN ======================= -->
<div class="modal fade" id="modalPembayaran" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-4">

            <div class="modal-pembayaran-bg">

                <!-- GRAND TOTAL + METODE -->
                <div class="payment-row mb-4">

                    <div>
                        <span class="label-text">Grand total :</span><br>
                        <input type="text" id="modalTotal" class="form-control form-mini mt-1" readonly>
                    </div>

                    <div>
                        <span class="label-text">Metode pembayaran :</span><br>
                        <select id="metodePembayaran" class="form-select form-mini mt-1">
                            <option value="cash">Tunai</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                </div>

                <!-- BOX DETAIL PEMBAYARAN -->
                <div class="p-3 rounded" style="background:rgba(255,255,255,0.65);">

                    <!-- CASH BOX -->
                    <div id="cashBox">
                        <span class="label-text">Bayar :</span>
                        <input type="number" id="jumlahBayar" name="bayar" class="form-control form-mini mt-1">

                        <span class="label-text mt-3 d-block">Kembalian :</span>
                        <input type="text" id="kembalian" class="form-control form-mini mt-1" readonly>
                    </div>

                    <!-- QRIS BOX -->
                    <div id="qrisBox" class="text-center d-none">
                        <img src="/img/qris.png" width="260" class="mt-2 mb-2">
                        <p class="fw-bold">Scan untuk membayar</p>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-batal" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-bayar" id="btnConfirmBayar">Bayar</button>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- ======================= MODAL SUKSES ======================= -->
<div class="modal fade" id="modalSukses" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content p-4" 
             style="background:#c6f4b1; border-radius: 15px; text-align:center;">
             
            <h4 class="mb-3 fw-bold">Pembayaran Berhasil!</h4>
            <button class="btn btn-bayar w-100" data-bs-dismiss="modal">OK</button>

        </div>
    </div>
</div>

<!-- ======================= SCRIPT ======================= -->
<script>
    const metodePembayaran = document.getElementById("metodePembayaran");
    const cashBox = document.getElementById("cashBox");
    const qrisBox = document.getElementById("qrisBox");

    // Ubah metode pembayaran
    metodePembayaran.addEventListener("change", function () {
        if (this.value === "cash") {
            cashBox.classList.remove("d-none");
            qrisBox.classList.add("d-none");
        } else {
            cashBox.classList.add("d-none");
            qrisBox.classList.remove("d-none");
        }
    });

    // Hitung kembalian
    const jumlahBayar = document.getElementById("jumlahBayar");
    const kembalianInput = document.getElementById("kembalian");
    const modalTotal = document.getElementById("modalTotal");

    jumlahBayar.addEventListener("input", function () {
        let total = parseInt(modalTotal.value || 0);
        let bayar = parseInt(jumlahBayar.value || 0);

        let kembalian = bayar - total;
        kembalianInput.value = kembalian >= 0 ? kembalian : 0;
    });

    // Tombol bayar
    document.getElementById("btnConfirmBayar").addEventListener("click", function () {

        // Masukkan nilai ke input hidden (kalau ada)
        let inputBayar = document.getElementById("inputBayar");
        let inputKembalian = document.getElementById("inputKembalian");

        if (inputBayar && inputKembalian) {
            inputBayar.value = jumlahBayar.value;
            inputKembalian.value = kembalianInput.value;
        }

        // Tutup modal pembayaran
        let modal1 = bootstrap.Modal.getInstance(document.getElementById("modalPembayaran"));
        modal1.hide();

        // Show modal sukses
        new bootstrap.Modal(document.getElementById("modalSukses")).show();

        // Submit form otomatis
        setTimeout(() => {
            document.querySelector("form").submit();
        }, 1200);
    });
</script>
