<?php
include 'header.php'; // Include the header
?>
<div class="container">
    <div class="card-container">
        <center><h1>Laporan</h1></center>
        <div class="row">
            <!-- Card for Stok Masuk -->
            <div class="card">
                <div class="card-body">
                    <h3>Laporan Stok Masuk</h3>
                    <a href="vw_stok.php" class="btn-link">Lihat Stok Masuk</a>
                </div>
            </div>
            
            <!-- Card for Transaksi -->
            <div class="card">
                <div class="card-body">
                    <h3>Laporan Transaksi</h3>
                    <a href="vw_transaksi.php" class="btn-link">Lihat Transaksi</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php'; // Include the footer
?>
