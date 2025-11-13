document.addEventListener("DOMContentLoaded", function () {
    // Form dan input
    const formTambah = document.getElementById("form-tambah-produk");
    const tabelProduk = document.getElementById("tabel-produk").querySelector("tbody");
    const inputNama = document.getElementById("nama-produk");
    const inputHarga = document.getElementById("harga-produk");
    const inputStok = document.getElementById("stok-produk");

    // Notif confirm hapus di Blade
    const notif = document.getElementById("simpleNotif");
    const cancelDelete = document.getElementById("cancelDelete");
    const confirmDelete = document.getElementById("confirmDelete");

    let rowToDelete = null;

    // === Tambah produk baru ===
    formTambah.addEventListener("submit", function (e) {
        e.preventDefault();

        const nama = inputNama.value.trim();
        const harga = inputHarga.value.trim();
        const stok = inputStok.value.trim();

        if (!nama || !harga || !stok) {
            alert("Isi semua data produk dulu ya 😭");
            return;
        }

        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${nama}</td>
            <td>Rp ${parseInt(harga).toLocaleString("id-ID")}</td>
            <td>${stok}</td>
            <td>
                <button class="btn-edit">Edit</button>
                <button class="crud-btn" style="background-color:#FCCD2A">
                    <i class="bi bi-trash3-fill"></i>
                </button>
            </td>
        `;
        tabelProduk.appendChild(row);
        formTambah.reset();
    });

    // === Klik tombol di tabel ===
    tabelProduk.addEventListener("click", function (e) {
        const row = e.target.closest("tr");
        if (!row) return;

        // Edit
        if (e.target.classList.contains("btn-edit")) {
            inputNama.value = row.children[0].textContent;
            inputHarga.value = row.children[1].textContent.replace("Rp ", "").replace(/\./g, "");
            inputStok.value = row.children[2].textContent;
            row.remove();
        }

        // Hapus
        if (e.target.closest(".crud-btn")) {
            rowToDelete = row;
            showNotif();
        }
    });

    // Tombol notif
    cancelDelete.addEventListener("click", function() {
        rowToDelete = null;
        hideNotif();
    });

    confirmDelete.addEventListener("click", function() {
        if (rowToDelete) rowToDelete.remove();
        rowToDelete = null;
        hideNotif();
    });

    // Fungsi animasi notif
    function showNotif() {
        notif.style.display = "block";
        notif.style.opacity = 0;
        notif.style.transform = "scale(0.8)";
        requestAnimationFrame(() => {
            notif.style.transition = "all 0.25s ease";
            notif.style.opacity = 1;
            notif.style.transform = "scale(1)";
        });
    }

    function hideNotif() {
        notif.style.transition = "all 0.25s ease";
        notif.style.opacity = 0;
        notif.style.transform = "scale(0.8)";
        setTimeout(() => {
            notif.style.display = "none";
        }, 250);
    }
});
