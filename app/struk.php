<?php
include 'database.php';
$db = new database();

if (isset($_GET['transaksi_id'])) {
    $transaksi_id = $_GET['transaksi_id'];

    $sql_transaksi = "SELECT t.* , u.nama
                        FROM transaksi t 
                        JOIN user u ON t.user = u.id
                        WHERE t.id = '$transaksi_id'";
    $result_transaksi = $db->mysqli->query($sql_transaksi);
    $transaksi = $result_transaksi->fetch_assoc();

    $sql_detail = "SELECT dt.*, p.namaProduk 
                   FROM detailtransaksi dt
                   JOIN produk p ON dt.produk_id = p.id
                   WHERE dt.transaksi_id = '$transaksi_id'";
    $result_detail = $db->mysqli->query($sql_detail);
} else {
    echo "Transaksi ID tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        .receipt {
            width: 300px;
            margin: auto;
            padding: 10px;
            border: 1px solid #000;
        }
        .receipt h1 {
            text-align: center;
        }
        .receipt .item {
            display: flex;
            justify-content: space-between;
        }
        .submit-button {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            align-self: center;
            text-align: center;
            display: block; 
            margin: auto; 
        }
        .submit-button:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
        }
        table {
            width: 100%; 
            border-collapse: collapse;
            margin-bottom: 20px; 
        }
        th, td {
            text-align: left; 
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Toko Bonedo</h1>
        <p>
            ID Transaksi: <?= $transaksi['id'] ?><br>
            Nama Pelanggan: <?= $transaksi['nama_pelanggan'] ?><br>
            Kasir: <?= $transaksi['nama'] ?><br>
            Tanggal: <?= $transaksi['tanggal'] ?><br>
        </p>
        <hr>
        <table>
            <tr>
                <th>Nama</th>
                <th>qty</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
            <?php while($row = $result_detail->fetch_assoc()): ?>
            <tr>
                <td><?= $row['namaProduk'] ?></td>
                <td><?= $row['quantity'] ?></td>
                <td><?= number_format($row['harga'], 2) ?></td>
                <td><?= number_format($row['total'], 2) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <hr>
        <div class="item">
            <span>Total</span>
            <span><?= number_format($transaksi['total'], 2) ?></span>
        </div>
        <div class="item">
            <span>Tunai</span>
            <span><?= number_format($transaksi['tunai'], 2) ?></span>
        </div>
        <div class="item">
            <span>Kembalian</span>
            <span><?= number_format($transaksi['kembalian'], 2) ?></span>
        </div>
        <hr>
    </div>
    <div class="form-top" style="display: flex; justify-content: center; align-items: center;">
        <button type="button" class="submit-button" style="margin: 10px;" onclick="goBack()">Kembali</button>
        <button class="submit-button" style="margin: 10px;" onclick="window.print()">Print Struk</button>
    </div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
