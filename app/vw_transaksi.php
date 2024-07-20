<?php
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filter'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $query = "SELECT id, user, total, tunai, kembalian, tanggal, nama_pelanggan FROM transaksi WHERE tanggal BETWEEN '$start_date' AND '$end_date'";
} else {
    $query = "SELECT t.id, u.nama, t.total, t.tunai, t.kembalian, t.tanggal, t.nama_pelanggan 
                FROM transaksi t
                JOIN user u ON t.user = u.id";
}

$result = mysqli_query($db->mysqli, $query);
?>

<div class="container">
    <h2>Daftar Transaksi</h2>
    
    <div style="display: flex; justify-content: space-evenly;">
        <form method="post" class="filter-form" style="flex: 1; margin-top: 30px;">
            <label for="start_date">Dari :</label>
            <input type="date" id="start_date" name="start_date">

            <label for="end_date">Hingga :</label>
            <input type="date" id="end_date" name="end_date">

            <button type="submit" name="filter" class="btn btn-primary">Filter</button>
        </form>
        
        <button onclick="printTransactions()" class="submit-button" style="margin-left: 525px;">Print</button>
    </div>

    <!-- Transaction table -->
    <table class="product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Total</th>
                <th>Tunai</th>
                <th>Kembalian</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nama_pelanggan']}</td>
                            <td>{$row['total']}</td>
                            <td>{$row['tunai']}</td>
                            <td>{$row['kembalian']}</td>
                            <td>{$row['tanggal']}</td>
                            <td>{$row['nama']}</td>
                            <td><a href='struk.php?transaksi_id={$row['id']}' class='action-link action-link-edit'>View</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8'><center>Tidak ada data transaksi</center></td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
