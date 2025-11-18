@extends('layout.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow p-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Tambah Transaksi</h4>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- FORM --}}
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            {{-- USER (otomatis user login) --}}
            <input type="hidden" name="id_user" value="{{ auth()->id() }}">

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
                    <option value="transfer">Qris</option>
                </select>
            </div>

            {{-- SUBMIT --}}
            <button type="submit" class="btn btn-warning w-100">Pembayaran</button>

        </form>
    </div>
</div>


{{-- ======================= --}}
{{-- SCRIPT PRODUK SEARCH --}}
{{-- ======================= --}}

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
            item.classList.add('list-group-item', 'list-group-item-action');

            item.innerHTML = `${p.nama_produk} - Rp ${p.harga_jual}`;
            item.onclick = () => addProduct(p);

            list.appendChild(item);
        }
    });
});

// TAMBAH PRODUK KE TABEL
function addProduct(p) {
    let tbody = document.querySelector("#tableItems tbody");

    if (document.getElementById('row-' + p.id_produk)) {
        alert("Produk sudah ditambahkan!");
        return;
    }

    let row = `
        <tr id="row-${p.id_produk}">
            <td>
                ${p.nama_produk}
                <input type="hidden" name="produk_id[]" value="${p.id_produk}">
            </td>

            <td>
                <input type="number" name="jumlah[]" class="form-control jumlah" value="1" min="1">
            </td>

            <td>
                <input type="number" class="form-control harga" value="${p.harga_jual}" readonly>
            </td>

            <td class="subtotal">${p.harga_jual}</td>

            <td>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${p.id_produk})">
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

// HAPUS PRODUK
function removeItem(id) {
    document.getElementById('row-' + id).remove();
    updateTotal();
}

// UPDATE TOTAL
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('jumlah')) updateTotal();
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
</script>

@endsection
