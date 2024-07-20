// header 
document.addEventListener('click', function(event) {
    var dropdown = document.querySelector('.dropdown-content');
    var dropbtn = document.querySelector('.dropbtn');

    if (dropbtn.contains(event.target)) {
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        dropbtn.classList.toggle('active');
    } else {
        dropdown.style.display = 'none';
        dropbtn.classList.remove('active');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.nav-link');

    links.forEach(link => {
        link.addEventListener('click', function () {
            links.forEach(link => link.classList.remove('active'));
            this.classList.add('active');
        });
    });

    const currentPath = window.location.pathname.split('/').pop();
    links.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
});

//kategori
document.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');

    window.openAddModal = function() {
        document.getElementById('kategoriId').value = '';
        document.getElementById('kategoriNama').value = '';
        document.getElementById('kategoriPrefix').value = '';
        document.getElementById('action').value = 'add';
        document.getElementById('modalTitle').innerText = 'Tambah Kategori';
        document.getElementById('kategoriModal').style.display = "block";
    }

    window.EditKategoriModal = function(id, nama, prefix) {
        console.log('EditKategoriModal called with:', id, nama, prefix);
        document.getElementById('kategoriId').value = id;
        document.getElementById('kategoriNama').value = nama;
        document.getElementById('kategoriPrefix').value = prefix;
        document.getElementById('action').value = 'edit';
        document.getElementById('modalTitle').innerText = 'Edit Kategori';
        document.getElementById('kategoriModal').style.display = "block";
    }

    window.closeModal = function() {
        console.log('closeModal called');
        document.getElementById('kategoriModal').style.display = "none";
    }

    window.DeleteKategori = function(id) {
        console.log('DeleteKategori called with:', id);
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteModal').style.display = "block";
    }

    window.closeDeleteModal = function() {
        console.log('closeDeleteModal called');
        document.getElementById('deleteModal').style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('kategoriModal')) {
            closeModal();
        }
        if (event.target == document.getElementById('deleteModal')) {
            closeDeleteModal();
        }
    }
});

//produk
document.addEventListener('DOMContentLoaded', (event) => {
    console.log('DOM fully loaded and parsed');

    document.getElementById('kategori').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var prefix = selectedOption.getAttribute('data-prefix');
        if (prefix) {
            document.getElementById('prefix').value = prefix;
        } else {
            document.getElementById('prefix').value = '';
        }
    });

    window.openModal = function(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    window.closeModal = function(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    window.openEditModal = function(id, kode_produk, nama_produk, harga, stock) {
        console.log('openEditModal called with:', id, kode_produk, nama_produk, harga, stock);
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_kode_produk').value = kode_produk;
        document.getElementById('edit_nama_produk').value = nama_produk;
        document.getElementById('edit_harga').value = harga;
        document.getElementById('edit_stock').value = stock;
        openModal('editProdukModal');
    }

    window.openDeleteModal = function(id) {
        console.log('openDeleteModal called with:', id);
        document.getElementById('delete_id').value = id;
        openModal('deleteModal');
    }

    window.openTambahStokModal = function(id) {
        console.log('openTambahStokModal called with:', id);
        document.getElementById('stok_id').value = id;
        openModal('tambahStokModal');
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('editProdukModal')) {
            closeModal('editProdukModal');
        }
        if (event.target == document.getElementById('deleteModal')) {
            closeModal('deleteModal');
        }
        if (event.target == document.getElementById('tambahStokModal')) {
            closeModal('tambahStokModal');
        }
    }
});

//stok
function printData() {
    var printContents = document.getElementById('stokTable').outerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = '<html><head><title>Print</title></head><body>' + printContents + '</body></html>';
    window.print();
    document.body.innerHTML = originalContents;
}

//transaksi_baru
document.querySelectorAll("input[type='checkbox']").forEach(function (checkbox) {
    checkbox.addEventListener('change', updateSummary);
});

document.querySelectorAll("input[name='quantity[]']").forEach(function (quantity) {
    quantity.addEventListener('input', updateSummary);
});

document.getElementById('tunai').addEventListener('input', updateKembalian);

function updateSummary() {
    let total = 0;
    let selectedProducts = "<h4>Produk:</h4><ul>";
    const checkboxes = document.querySelectorAll("input[type='checkbox']");
    const quantities = document.querySelectorAll("input[name='quantity[]']");
    const prices = document.querySelectorAll("input[name='harga[]']");

    checkboxes.forEach(function (checkbox, index) {
        if (checkbox.checked) {
            let namaProduk = checkbox.getAttribute('data-namaproduk');
            let harga = parseFloat(prices[index].value) || 0;
            let quantity = parseInt(quantities[index].value) || 1;
            total += harga * quantity;
            selectedProducts += `<li>${namaProduk} x ${quantity} @ ${harga.toFixed(2)} = ${(harga * quantity).toFixed(2)}</li>`;
        }
    });

    selectedProducts += "</ul>";

    if (total === 0) {
        selectedProducts = "<p>Tidak ada produk yang dipilih</p>";
    }

    document.getElementById('selected-products').innerHTML = selectedProducts;
    document.getElementById('total').value = total.toFixed(2);
    updateKembalian();
}

function updateKembalian() {
    let total = parseFloat(document.getElementById('total').value) || 0;
    let tunai = parseFloat(document.getElementById('tunai').value) || 0;
    let kembalian = tunai - total;
    document.getElementById('kembalian').value = kembalian.toFixed(2);
}

// transaksi
function printTransactions() {
    // Dapatkan konten tabel
    var printContent = document.querySelector('.product-table').outerHTML;
    
    // Buka jendela baru untuk mencetak
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContents;
}

//user

