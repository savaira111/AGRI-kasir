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
</style>

<div class="modal fade" id="modalPembayaran" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-4">
            
            <div class="modal-pembayaran-bg">

                <!-- GRAND TOTAL -->
                <div class="mb-4">
                    <span class="label-text">Grand Total :</span><br>
                    <input type="text" id="modalTotal" class="form-control form-mini mt-1" readonly>
                </div>

                
                <!-- BOX CASH / QRIS -->
                <div class="p-3 rounded" style="background:rgba(255,255,255,0.65);">

                    <!-- CASH -->
                    <div id="cashBox">
                        <span class="label-text">Bayar :</span>
                        <input type="number" id="jumlahBayar" name="bayar" class="form-control form-mini mt-1">

                        <span class="label-text mt-3 d-block">Kembalian :</span>
                        <input type="text" id="kembalian" class="form-control form-mini mt-1" readonly>
                    </div>

                    <!-- QRIS -->
                    <div id="qrisBox" class="text-center d-none">
                        <img src="/image/qris.jpg" width="260" class="mt-2 mb-2">
                        <p class="fw-bold">Scan untuk membayar</p>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-batal" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-bayar" id="btnConfirmBayar">Bayar</button>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    // SWITCH CASH / QRIS
    document.getElementById("metodePembayaran").addEventListener("change", function () {
        if (this.value === "cash") {
            document.getElementById("cashBox").classList.remove("d-none");
            document.getElementById("qrisBox").classList.add("d-none");
        } else {
            document.getElementById("cashBox").classList.add("d-none");
            document.getElementById("qrisBox").classList.remove("d-none");
        }
    });

    // Hitung kembalian
    document.getElementById("jumlahBayar").addEventListener("input", function () {
        let total = parseInt(document.getElementById('modalTotal').value || 0);
        let bayar = parseInt(this.value || 0);
        let kembali = bayar - total;
        document.getElementById('kembalian').value = kembali > 0 ? kembali : 0;
    });
</script>
