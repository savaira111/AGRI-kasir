@extends('layout.app')

@section('content')
<div class="container mt-4">

    <a href="{{ route('transactions.index') }}" class="btn btn-warning rounded-circle d-flex align-items-center justify-content-center me-3"
       style="width: 40px; height: 40px;">
        <i class="bi bi-arrow-left-short fs-4 text-dark"></i>
    </a>

    <div class="card shadow p-4">
        <h4 class="fw-bold mb-3">Tambah Transaksi</h4>

        @if(session()->has("error"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>{{session("error")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <form id="transactionForm" action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
            <input type="hidden" name="total_harga" id="totalInput">
            <input type="hidden" name="bayar" id="hiddenBayar">
            <input type="hidden" name="kembalian" id="hiddenKembalian">

            {{-- Tanggal --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Transaksi</label>
                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
            </div>

            {{-- Cari Produk --}}
            <div class="mb-3">
                <label class="form-label">Cari Produk</label>
                <input type="text" id="searchProduct" class="form-control" placeholder="Ketik nama produk...">
                <div id="productList" class="list-group mt-1"></div>
            </div>

            {{-- Tabel Produk --}}
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

            {{-- Total & Metode Bayar --}}
            <div id="fixed-footer">
                <div class="text-end mb-3">
                    <h5>Total: <span id="totalDisplay">0</span></h5>
                </div>

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="form-select" id="metodeBayar">
                        <option value="cash">Cash</option>
                        <option value="qris">Qris</option>
                    </select>
                </div>

                {{-- QRIS --}}
                <div id="qrisCreateBox" class="text-center mb-3" style="display:none;">
                    <p class="fw-bold">Scan untuk bayar:</p>
                    <img src="/image/qrish.jpg" style="max-width:230px;">
                </div>

                {{-- Modal pembayaran --}}
                @include('transactions.modal-payment')

                <button type="button" class="btn btn-warning w-100" id="openModalPembayaran">Pembayaran</button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL PERINGATAN STOK -->
<div class="modal fade" id="stokAlertModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Peringatan Stok</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Jumlah yang dimasukkan melebihi stok yang tersedia!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Oke</button>
      </div>
    </div>
  </div>
</div>

<script>
let products = @json($produk);

// SEARCH PRODUK
document.getElementById('searchProduct').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let list = document.getElementById('productList');
    list.innerHTML = "";

    if (keyword.length < 1) return;

    products.forEach(p => {
        if (p.nama_produk.toLowerCase().includes(keyword)) {
            let item = document.createElement('a');
            item.classList.add('list-group-item');

            // tampil nama + stok
            item.innerHTML = `${p.nama_produk} (Stok: ${p.stok_produk})`;

            // klikable hanya kalau stok > 0
            if (p.stok_produk > 0) {
                item.classList.add('list-group-item-action');
                item.style.cursor = "pointer";
                item.onclick = () => addProduct(p);
            } else {
                item.style.cursor = "not-allowed";
                item.style.opacity = 0.6;
            }

            list.appendChild(item);
        }
    });
});

// TAMBAH PRODUK KE TABEL
function addProduct(p) {
    let id = p.id_produk ?? p.id;
    let tbody = document.querySelector("#tableItems tbody");

    if (document.getElementById('row-' + id)) {
        alert("Produk sudah ada!");
        return;
    }

    let harga = parseInt(p.harga_jual) || 0;
    let stok = parseInt(p.stok_produk) || 0;

    let row = `
        <tr id="row-${id}">
            <td>${p.nama_produk}<input type="hidden" name="produk_id[]" value="${id}"></td>
            <td><input type="number" name="jumlah[]" class="form-control jumlah" min="1" max="${stok}" value="1"></td>
            <td><input type="number" class="form-control harga" value="${harga}" readonly></td>
            <td class="subtotal">${harga}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="removeItem('${id}')"><i class="bi bi-trash"></i></button></td>
        </tr>
    `;
    tbody.insertAdjacentHTML('beforeend', row);
    document.getElementById('productList').innerHTML = "";
    document.getElementById('searchProduct').value = "";
    updateTotal();
}

// REMOVE PRODUK
function removeItem(id) {
    document.getElementById('row-' + id).remove();
    updateTotal();
}

// UPDATE TOTAL
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('jumlah')) {
        let input = e.target;
        let max = parseInt(input.getAttribute('max')) || 0;
        if (parseInt(input.value) > max) {
            input.value = max;
            let stokAlertModal = document.getElementById('stokAlertModal');
            new bootstrap.Modal(stokAlertModal).show();
        }
        updateTotal();
    }
});

function updateTotal() {
    let total = 0;
    document.querySelectorAll("#tableItems tbody tr").forEach(tr => {
        let jumlah = parseInt(tr.querySelector(".jumlah").value);
        let harga = parseInt(tr.querySelector(".harga").value);
        let subtotal = jumlah * harga;
        tr.querySelector(".subtotal").innerText = subtotal;
        total += subtotal;
    });
    document.getElementById('totalDisplay').innerText = total;
    document.getElementById('totalInput').value = total;
}

// SWITCH METODE BAYAR
const metodeBayar = document.getElementById("metodeBayar");
const qrisCreateBox = document.getElementById("qrisCreateBox");
const cashBox = document.getElementById("cashBox");
const qrisBox = document.getElementById("qrisBox");
const openModal = document.getElementById("openModalPembayaran");
const modalTotal = document.getElementById("modalTotal");
const jumlahBayar = document.getElementById("jumlahBayar");
const kembalianInput = document.getElementById("kembalian");
const btnBayar = document.getElementById("btnConfirmBayar");

metodeBayar.addEventListener("change", function () {
    if (this.value === "cash") {
        cashBox.classList.remove("d-none");
        qrisBox.classList.add("d-none");
        qrisCreateBox.style.display = "none";
    } else {
        cashBox.classList.add("d-none");
        qrisBox.classList.remove("d-none");
        qrisCreateBox.style.display = "block";
    }
});

// MODAL / QRIS SUBMIT
openModal.addEventListener("click", function () {
    updateTotal();
    const total = parseInt(document.getElementById("totalInput").value || 0);
    const metode = metodeBayar.value;

    if (metode === "cash") {
        modalTotal.value = total;
        jumlahBayar.value = "";
        kembalianInput.value = "";
        btnBayar.disabled = true;
        new bootstrap.Modal(document.getElementById("modalPembayaran")).show();
    } else {
        document.getElementById("hiddenBayar").value = total;
        document.getElementById("hiddenKembalian").value = 0;
        document.getElementById("transactionForm").submit();
    }
});

// HITUNG KEMBALIAN CASH
jumlahBayar.addEventListener("input", function () {
    const total = parseInt(modalTotal.value || 0);
    const bayar = parseInt(jumlahBayar.value || 0);
    const kembalian = bayar - total;
    if (kembalian >= 0) {
        kembalianInput.value = kembalian;
        btnBayar.disabled = false;
    } else {
        kembalianInput.value = "";
        btnBayar.disabled = true;
    }
});

// KONFIRMASI BAYAR CASH
btnBayar.addEventListener("click", function () {
    document.getElementById("hiddenBayar").value = jumlahBayar.value;
    document.getElementById("hiddenKembalian").value = kembalianInput.value;
    document.getElementById("transactionForm").submit();
});
</script>
@endsection
