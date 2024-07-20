<?php
require_once "Session.php";
$session = new Session();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toko bonedo</title>
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>
    <div class="navbar">
        <div class="app-title">
            <h1 style="margin-left: 30px;">Toko bonedo</h1>
        </div>
        <div class="nav-links">
            <?php if ($session->user_role == 'admin') { ?>
                <a href="vw_dashboard.php" class="nav-link">Dashboard</a>
                <a href="vw_kategori.php" class="nav-link">Kategori</a>
                <a href="vw_produk.php" class="nav-link">Produk</a>
                <a href="vw_user.php" class="nav-link">User</a>
                <a href="vw_laporan.php" class="nav-link">Laporan</a>
            <?php } elseif ($session->user_role == 'kasir') { ?>
                <a href="vw_dashboard.php" class="nav-link">Dashboard</a>
                <a href="vw_transaksi_baru.php" class="nav-link">Transaksi</a>
            <?php } elseif ($session->user_role == 'inventori') { ?>
                <a href="vw_dashboard.php" class="nav-link">Dashboard</a>
                <a href="vw_kategori.php" class="nav-link">Kategori</a>
                <a href="vw_produk.php" class="nav-link">Produk</a>
            <?php } elseif ($session->user_role == 'manager') { ?>
                <a href="vw_dashboard.php" class="nav-link">Dashboard</a>
                <a href="vw_laporan.php" class="nav-link">Laporan</a>
            <?php } ?>
        </div>
        <div class="dropdown">
            <button class="dropbtn"><?php echo $session->login_user ?> - <?php echo $session->user_role ?></button>
            <div class="dropdown-content">
                <a href="?logout=true">Logout</a>
            </div>
        </div>
    </div>