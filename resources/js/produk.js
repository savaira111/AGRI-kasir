// kelola-produk.js

document.addEventListener("DOMContentLoaded", function () {
    const formTambah = document.getElementById("form-tambah-produk");
    const tabelProduk = document.getElementById("tabel-produk");
    const inputNama = document.getElementById("nama-produk");
    const inputHarga = document.getElementById("harga-produk");
    const inputStok = document.getElementById("stok-produk");

    // Tambah produk baru
    formTambah.addEventListener("submit", function (e) {
        e.preventDefault();

        const nama = inputNama.value.trim();
        const harga = inputHarga.value.trim();
        const stok = inputStok.value.trim();

        if (nama === "" || harga === "" || stok === "") {
            alert("Isi semua data produk dulu yaa ");
            return;
        }

        const row = document.createElement("tr");

        row.innerHTML = `
            <td>${nama}</td>
            <td>Rp ${parseInt(harga).toLocaleString("id-ID")}</td>
            <td>${stok}</td>
            <td>
                <button class="btn-edit">Edit</button>
                <button class="btn-hapus">Hapus</button>
            </td>
        `;

        tabelProduk.querySelector("tbody").appendChild(row);

        // Reset form
        formTambah.reset();
    });

    // Hapus produk
    tabelProduk.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-hapus")) {
            const row = e.target.closest("tr");
            row.remove();
        }
    });

    // Edit produk
    tabelProduk.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-edit")) {
            const row = e.target.closest("tr");
            const nama = row.children[0].textContent;
            const harga = row.children[1].textContent.replace("Rp ", "").replace(/\./g, "");
            const stok = row.children[2].textContent;

            inputNama.value = nama;
            inputHarga.value = harga;
            inputStok.value = stok;

            row.remove();
        }
    });
});
