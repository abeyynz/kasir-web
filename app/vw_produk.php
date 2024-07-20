<?php
include 'header.php';

$search = '';
if (isset($_POST['search_product'])) {
    $search = $_POST['search_product'];
}

$query = "SELECT id, kode_produk, namaProduk, harga, stock FROM produk WHERE namaProduk LIKE '%$search%' OR kode_produk LIKE '%$search%'";
$result = mysqli_query($db->mysqli, $query);

$kategoriSql = "SELECT id, prefix, kategori FROM kategori";
$kategoriResult = mysqli_query($db->mysqli, $kategoriSql);
?>
<div class="container">
    <h2>Daftar Produk</h2>
    <div class="form-top" style="display: flex; justify-content: space-between; align-items: center;">
        <button type="button" class="submit-button" style="margin-left: 100px;" onclick="openModal('tambahProdukModal')">Tambah Produk</button>
        <button type="button" class="submit-button" style="margin-right: 450px;" onclick="openModal('tambahStokModal')">Tambah Stok</button>
        <div style="display: flex; margin-right: 100px; margin-bottom: -25px;">
            <form id="searchForm" action="" method="POST">
                <input type="text" id="search_product" name="search_product" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>" style="width: 200px;">
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
    <table class="product-table">
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr class='table-row'>";
                echo "<td>{$row['kode_produk']}</td>";
                echo "<td>{$row['namaProduk']}</td>";
                echo "<td>{$row['harga']}</td>";
                echo "<td>{$row['stock']}</td>";
                echo "<td>
                        <a href='#' class='action-link action-link-edit' onclick=\"openEditModal('". $row["id"] ."', '". htmlspecialchars($row["kode_produk"]) ."', '". htmlspecialchars($row["namaProduk"]) ."', '". htmlspecialchars($row["harga"]) ."', '". htmlspecialchars($row["stock"]) ."')\">Edit</a>
                        <a href='#' class='action-link action-link-delete' onclick=\"openDeleteModal('". $row["id"] ."')\">Hapus</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'><center>Tidak ada produk</center></td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>



<!-- Modal Tambah Produk -->
<div id="tambahProdukModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('tambahProdukModal')">&times;</span>
        <h2>Tambah Produk</h2>
        <form action="produk.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <select id="kategori" name="kategori" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    <?php
                    if ($kategoriResult->num_rows > 0) {
                        while($kategoriRow = $kategoriResult->fetch_assoc()) {
                            echo "<option value='" . $kategoriRow['id'] . "' data-prefix='" . $kategoriRow['prefix'] . "'>" . $kategoriRow['kategori'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar Produk:</label>
                <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-button">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Stok -->
<div id="tambahStokModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('tambahStokModal')">&times;</span>
        <h2>Tambah Stok</h2>
        <form action="produk.php" method="post">
            <input type="hidden" name="action" value="add_stock">
            <input type="hidden" name="user" value="<?php echo $session->iduser; ?>"> 
            <div class="form-group">
                <label for="produk_id">Produk:</label>
                <select id="produk_id" name="produk_id" class="form-control" required>
                    <option value="">Pilih Produk</option>
                    <?php
                    $produkResult = $db->mysqli->query("SELECT id, kode_produk, namaProduk FROM produk");
                    if ($produkResult->num_rows > 0) {
                        while($produkRow = $produkResult->fetch_assoc()) {
                            echo "<option value='" . $produkRow['id'] . "'>" . $produkRow['kode_produk'] . " - " . $produkRow['namaProduk'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="stock_tambah">Jumlah Stok:</label>
                <input type="number" id="stock_tambah" name="stock_tambah" class="form-control" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-button">Tambah</button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Edit Produk -->
<div id="editProdukModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editProdukModal')">&times;</span>
        <h2>Edit Produk</h2>
        <form action="produk.php" method="post">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" id="edit_id" name="id">
            <div class="form-group">
                <label for="edit_kode_produk">Kode Produk:</label>
                <input type="text" id="edit_kode_produk" name="kode_produk" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="edit_nama_produk">Nama Produk:</label>
                <input type="text" id="edit_nama_produk" name="nama_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_harga">Harga:</label>
                <input type="number" id="edit_harga" name="harga" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="edit_stock">Stock:</label>
                <input type="number" id="edit_stock" name="stock" class="form-control" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="submit-button">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus Produk -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('deleteModal')">&times;</span>
        <h2>Konfirmasi Hapus</h2>
        <p>Apakah kamu yakin mengahpus kategori ini?</p>
        <form action="produk.php" method="post">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" id="delete_id" name="id">
            <div class="form-actions">
                <button type="submit" class="submit-button">Delete</button>
                <button type="button" class="submit-button" onclick="closeModal('deleteModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>
<script>
    function searchProduct() {
        document.getElementById('searchForm').submit();
    }
</script>

<?php 
    include 'footer.php';
?>
