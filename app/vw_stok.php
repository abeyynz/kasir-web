<?php
include 'header.php';
$query = "SELECT sm.id, p.kode_produk, p.namaProduk, sm.jumlah, sm.createdAt, sm.user, u.nama
          FROM stok_masuk sm
          JOIN produk p ON sm.produk_id = p.id
          JOIN user u ON sm.user = u.id
          ORDER BY sm.createdAt DESC";

$result = mysqli_query($db->mysqli, $query);

?>

<div class="container">
    <h2>Data Stok Masuk</h2>
    <button onclick="printData()" class="print-button submit-button" style="align-self: flex-end; margin-right: 100px;">Print</button>
    <table class="product-table" id="stokTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Staff</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['kode_produk']}</td>
                            <td>{$row['namaProduk']}</td>
                            <td>{$row['jumlah']}</td>
                            <td>{$row['nama']}</td>
                            <td>{$row['createdAt']}</td>
                          </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data stok masuk ditemukan</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include 'footer.php'; 
?>
