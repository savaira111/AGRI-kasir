@extends('layout.app')

@section('content')
        @if(session()->has("error"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>gagal: {{session("error")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
<div class="container mt-4">

   <a href="{{ route('transactions.index') }}"
   class="btn btn-warning rounded-circle d-flex align-items-center justify-content-center me-3"
   style="width: 40px; height: 40px; margin-top: 30px; margin-left: 10px">
    <i class="bi bi-arrow-left-short fs-4 text-dark"></i>
</a>



    <div class="card shadow p-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Tambah Transaksi</h4>
        </div>

        {{-- FORM --}}
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            {{-- USER --}}
            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

            {{-- TANGGAL --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
            </div>

            {{-- CARI PRODUK --}}
            <div class="mb-3">
                <label class="form-label">Cari Produk</label>
                <input type="text" id="searchProduct" class="form-control" placeholder="Ketik nama produk...">
                <div id="productList" class="list-group mt-1"></div>
            </div>

            {{-- TABEL PRODUK --}}
            <table class="table table-bordered" id="tableItems">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th width="100px">Jumlah</th>
                        <th width="120px">Harga</th>
                        <th width="120px">Subtotal</th>
                        <th width="70px">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <div id="fixed-footer">
            {{-- TOTAL --}}
            <div class="text-end mb-3">
                <h5>Total: <span id="totalDisplay">0</span></h5>
                <input type="hidden" name="total_harga" id="totalInput">
            </div>

            {{-- METODE BAYAR --}}
            <div class="mb-4">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-select" required>
                    <option value="cash">Cash</option>
                    <option value="qris">Qris</option>
                </select>
            </div>
            
            @include('transactions.modal-payment')

                <button type="button" class="btn btn-warning w-100" id="openModalPembayaran">
                    Pembayaran
                </button>
            </div>

        </form>
    </div>
</div>


{{-- ================================
   JAVASCRIPT — FULL FIXED
================================ --}}
<script>

    /* =========================================
       LOAD PRODUK DARI CONTROLLER
    ========================================== */
    let products = @json($produk);

    /* =========================================
       SEARCH PRODUK
    ========================================== */
    document.getElementById('searchProduct').addEventListener('keyup', function () {
        let keyword = this.value.toLowerCase();
        let list = document.getElementById('productList');
        list.innerHTML = "";

        if (keyword.length < 1) return;

        products.forEach(p => {
            if (p.nama_produk.toLowerCase().includes(keyword)) {

                let item = document.createElement('a');
                item.classList.add('list-group-item', 'list-group-item-action');
                item.innerHTML = `${p.nama_produk} - Rp ${p.harga_jual}`;
                item.onclick = () => addProduct(p);

                list.appendChild(item);
            }
        });
    });

    /* =========================================
       TAMBAH PRODUK KE TABEL
    ========================================== */
    function addProduct(p) {

        let id = p.id_produk ?? p.id;

        let tbody = document.querySelector("#tableItems tbody");

        if (document.getElementById('row-' + id)) {
            alert("Produk sudah ada!");
            return;
        }

        let row = `
            <tr id="row-${id}">
                <td>
                    ${p.nama_produk}
                    <input type="hidden" name="produk_id[]" value="${id}">
                </td>
                <td>
                    <input type="number" name="jumlah[]" class="form-control jumlah" min="1" value="1">
                </td>
                <td>
                    <input type="number" class="form-control harga" value="${p.harga_jual}" readonly>
                </td>
                <td class="subtotal">${p.harga_jual}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem('${id}')">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `;

        tbody.insertAdjacentHTML('beforeend', row);

        document.getElementById('productList').innerHTML = "";
        document.getElementById('searchProduct').value = "";

        updateTotal();
    }

    /* =========================================
       HAPUS PRODUK
    ========================================== */
    function removeItem(id) {
        document.getElementById('row-' + id).remove();
        updateTotal();
    }

    /* =========================================
       UPDATE TOTAL
    ========================================== */
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('jumlah')) updateTotal();
    });

    function updateTotal() {
        let total = 0;

        document.querySelectorAll("#tableItems tbody tr").forEach(tr => {
            let jumlah = parseInt(tr.querySelector(".jumlah").value);
            let harga  = parseInt(tr.querySelector(".harga").value);

            let subtotal = jumlah * harga;
            tr.querySelector(".subtotal").innerText = subtotal;

            total += subtotal;
        });

        document.getElementById('totalDisplay').innerText = total;
        document.getElementById('totalInput').value = total;
    }

    /* =========================================
       OPEN MODAL PEMBAYARAN
    ========================================== */
    document.getElementById("openModalPembayaran").addEventListener("click", function () {

        let total = document.getElementById("totalInput").value;

        document.getElementById("modalTotal").value = total;
        document.getElementById("jumlahBayar").value = "";
        document.getElementById("kembalian").value = "";

        new bootstrap.Modal(document.getElementById("modalPembayaran")).show();
    });

    /* =========================================
       LOGIC PEMBAYARAN
    ========================================== */
    const bayarInput = document.getElementById("jumlahBayar");
    const totalModal = document.getElementById("modalTotal");
    const btnBayar = document.getElementById("btnConfirmBayar");

    btnBayar.disabled = true;

    bayarInput.addEventListener("input", function() {
        let total = parseInt(totalModal.value) || 0;
        let bayar = parseInt(bayarInput.value) || 0;

        let kembali = bayar - total;

        if (kembali >= 0) {
            kembalianInput.value = kembali;
            btnBayar.disabled = false;
        } else {
            kembalianInput.value = "";
            btnBayar.disabled = true;
        }
    });

    /* =========================================
       SUBMIT TRANSAKSI
    ========================================== */
    btnBayar.addEventListener("click", function () {

        let modalPembayaran = bootstrap.Modal.getInstance(document.getElementById("modalPembayaran"));
        modalPembayaran.hide();

        new bootstrap.Modal(document.getElementById("modalSukses")).show();

        setTimeout(() => {
            document.querySelector("form").submit();
        }, 1200);
    });

</script>

@endsection
