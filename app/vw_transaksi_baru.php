<?php
include 'header.php';

$search = '';
if (isset($_POST['search_product'])) {
    $search = $_POST['search_product'];
}

$query = "SELECT id, kode_produk, namaProduk, harga, gambar FROM produk WHERE stock > 0 AND (namaProduk LIKE '%$search%' OR kode_produk LIKE '%$search%')";
$result = mysqli_query($db->mysqli, $query);

?>

<div class="container">
    <form id="searchForm" action="" method="POST" style="margin-top: 70px; margin-right: -200px;  position: relative; z-index: 1;">
            <input type="text" id="search_product" name="search_product" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>" style="width: 200px;">
            <button type="submit">Cari</button>
    </form>
    <form method="POST" action="transaksi_baru.php" style="position: relative; z-index: 0;">
        <div class="flex-container">
            <div class="produk-selection">
                <h2>Pilih Produk</h2>
                <div class="produk-container">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='produk-card'>
                                    <img src='Assets/img/{$row['gambar']}' alt='{$row['namaProduk']}' width='150' height='150'>
                                    <p>
                                        {$row['kode_produk']}</br>
                                        {$row['namaProduk']}</br>
                                        Harga: {$row['harga']}
                                    </p>
                                    <input type='checkbox' name='produk_id[]' value='{$row['id']}' data-namaproduk='{$row['namaProduk']}' data-harga='{$row['harga']}'>
                                    <input type='hidden' name='harga[]' value='{$row['harga']}'>
                                    <label for='quantity'>Jumlah:</label>
                                    <input type='number' name='quantity[]' min='1' max='100' value='1'>
                                </div>";
                        }
                    } else {
                        echo "Tidak ada produk tersedia";
                    }
                    ?>
                </div>
            </div>

            <div class="transaksi-summary">
                <h2>Transaksi</h2>
                <div class="form-group">
                    <label for="nama_pelanggan">Nama :</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" class="form-control" required>
                </div>
                <div id="selected-products">
                    <p>Tidak ada produk yang dipilih</p>
                </div>
                <div class="form-group">
                    <label for="total">Total:</label>
                    <input type="text" id="total" name="total" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="tunai">Tunai:</label>
                    <input type="text" id="tunai" name="tunai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="kembalian">Kembalian:</label>
                    <input type="text" id="kembalian" name="kembalian" class="form-control" readonly>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-button">Bayar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function searchProduct() {
        document.getElementById('searchForm').submit();
    }
</script>

<?php
include 'footer.php';
?>
