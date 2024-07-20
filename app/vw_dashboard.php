<?php
include 'header.php';
// Query untuk mendapatkan jumlah stok barang
$totalStockQuery = "SELECT SUM(stock) AS total_stok FROM produk";
$totalStockResult = mysqli_query($db->mysqli, $totalStockQuery);
$totalStock = $totalStockResult->fetch_assoc()['total_stok'];

// Query untuk mendapatkan produk terlaris
$bestSellingProductQuery = "
    SELECT produk.namaProduk, SUM(detailtransaksi.quantity) AS total_terjual
    FROM detailtransaksi
    JOIN produk ON detailtransaksi.produk_id = produk.id
    GROUP BY produk.id
    ORDER BY total_terjual DESC
    LIMIT 1
";

$bestSellingProductResult = mysqli_query($db->mysqli, $bestSellingProductQuery);
$bestSellingProduct = $bestSellingProductResult->fetch_assoc();

// Query untuk mendapatkan jumlah uang hasil penjualan
$totalSalesQuery = "SELECT SUM(total) AS total_penjualan FROM transaksi";
$totalSalesResult = mysqli_query($db->mysqli, $totalSalesQuery);
$totalSales = $totalSalesResult->fetch_assoc()['total_penjualan'];

// Query untuk mendapatkan jumlah pelanggan
$totaltransaksiQuery = "SELECT COUNT(DISTINCT id) AS total_transaksi FROM transaksi";
$totaltransaksiResult = mysqli_query($db->mysqli, $totaltransaksiQuery);
$totaltransaksi = $totaltransaksiResult->fetch_assoc()['total_transaksi'];

$totalUsersQuery = "SELECT COUNT(*) AS total_pengguna FROM user";
$totalUsersResult = mysqli_query($db->mysqli, $totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['total_pengguna'];
?>
<div class="container">
    <div class="card-container" style="margin-top: 50px;">
        <div class="row">
            <div class="card">
                <h3>Total Stok Barang</h3>
                <p style="font-size: 36;"><?php echo $totalStock; ?></p>
            </div>
            <?php if ($bestSellingProduct !== null): ?>
                <div class="card">
                    <h3>Produk Terlaris</h3>
                    <p>Nama Produk: <?php echo $bestSellingProduct['namaProduk']; ?></p>
                    <p>Total Terjual: <?php echo $bestSellingProduct['total_terjual']; ?></p>
                </div>
            <?php else: ?>
                <div class="card">
                    <h3>Produk Terlaris</h3>
                    <p>Tidak ada data penjualan.</p>
                </div>
            <?php endif; ?>
            <div class="card">
                <h3>Total Uang Hasil Penjualan</h3>
                <p>Rp <?php echo number_format($totalSales, 2, ',', '.'); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <h3>Total Pelanggan</h3>
                <p style="font-size: 36;"><?php echo $totaltransaksi; ?></p>
            </div>
            <div class="card">
                <h3>Produk dengan Stok Menipis</h3>
                <?php if (empty($lowStockProducts)): ?>
                    <p>Tidak ada</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($lowStockProducts as $product): ?>
                            <li><?php echo $product['namaProduk']; ?>: <?php echo $product['stock']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="card">
                <h3>Total User</h3>
                <p style="font-size: 36;"><?php echo $totalUsers; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>