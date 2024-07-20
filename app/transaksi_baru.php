<?php
include 'database.php';
$db = new database();
require_once "Session.php";
$session = new Session();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $total = $_POST['total'];
    $tunai = $_POST['tunai'];
    $kembalian = $_POST['kembalian'];
    $iduser = $session->iduser; 

    $sql_transaksi = "INSERT INTO transaksi (user, total, tunai, kembalian, nama_pelanggan) VALUES ('$iduser', '$total', '$tunai', '$kembalian', '$nama_pelanggan')";
    if ($db->mysqli->query($sql_transaksi) === TRUE) {
        $transaksi_id = $db->mysqli->insert_id;

        foreach ($_POST['produk_id'] as $index => $produk_id) {
            $quantity = $_POST['quantity'][$index];
            $harga = $_POST['harga'][$index];
            $total_detail = $harga * $quantity;
            
            $sql_detail = "INSERT INTO detailtransaksi (transaksi_id, produk_id, quantity, harga, total) VALUES ('$transaksi_id', '$produk_id', '$quantity', '$harga', '$total_detail')";
            if ($db->mysqli->query($sql_detail) !== TRUE) {
                echo "Error: " . $sql_detail . "<br>" . $db->mysqli->error;
                continue;
            }

            $sql_get_stock = "SELECT stock FROM produk WHERE id = '$produk_id'";
            $result = $db->mysqli->query($sql_get_stock);
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $new_stok = $row['stock'] - $quantity;

                $sql_update_stock = "UPDATE produk SET stock = '$new_stok' WHERE id = '$produk_id'";
                if ($db->mysqli->query($sql_update_stock) !== TRUE) {
                    echo "Error: " . $sql_update_stock . "<br>" . $db->mysqli->error;
                }
            } else {
                echo "Error fetching stock for product ID: $produk_id";
            }
        }

        header("Location: struk.php?transaksi_id=$transaksi_id");
        exit();
    } else {
        echo "Error: " . $sql_transaksi . "<br>" . $db->mysqli->error;
    }
} else {
    echo "Request method tidak valid.";
}
?>
