<?php
include 'database.php';
$db = new database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $kategori_id = $_POST['kategori'];
                $nama_produk = $_POST['nama_produk'];
                $harga = $_POST['harga'];
    
                if (!empty($kategori_id) && !empty($nama_produk) && !empty($harga)) {
                    
                    $target_dir = "Assets/img/";
                    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
                    
                    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
                    if ($check === false) {
                        echo "File bukan berupa gambar";
                        exit;
                    }
    
                    if ($_FILES["gambar"]["size"] > 5000000) { // 5MB max
                        echo "Ukuran File terlalu besar!";
                        exit;
                    }
    
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        exit;
                    }
    
                    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                        $gambar = basename($_FILES["gambar"]["name"]);
                    } else {
                        echo "Error mengunggah file";
                        exit;
                    }
    
                    $prefixQuery = "SELECT prefix FROM kategori WHERE id = ?";
                    if ($stmt = $db->mysqli->prepare($prefixQuery)) {
                        $stmt->bind_param("i", $kategori_id);
                        $stmt->execute();
                        $prefixResult = $stmt->get_result();
                        $prefixRow = $prefixResult->fetch_assoc();
                        $prefix = $prefixRow['prefix'];
                    }
    
                    $idQuery = "SELECT MAX(id) AS max_id FROM produk";
                    $idResult = $db->mysqli->query($idQuery);
                    $idRow = $idResult->fetch_assoc();
                    $latestId = $idRow['max_id'] + 1;
    
                    $kode_produk = $prefix . str_pad($latestId, 3, '0', STR_PAD_LEFT);
    
                    $query = "INSERT INTO produk (kategori_id, kode_produk, namaProduk, harga, stock, createdAt, updatedAt, gambar) VALUES (?, ?, ?, ?, 0, NOW(), NOW(), ?)";
                    if ($stmt = $db->mysqli->prepare($query)) {
                        $stmt->bind_param("issss", $kategori_id, $kode_produk, $nama_produk, $harga, $gambar);
                        if ($stmt->execute()) {
                            header("Location: vw_produk.php");
                            exit();
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                    } else {
                        echo "Error: " . $db->mysqli->error;
                    }
                } else {
                    echo "All fields are required.";
                }
                break;

            case 'add_stock':
                $produk_id = $_POST['produk_id'];
                $stock_tambah = $_POST['stock_tambah'];
                $user = $_POST['user']; 

                if (!empty($produk_id) && !empty($stock_tambah) && !empty($user)) {
                    
                    $query = "UPDATE produk SET stock = stock + ? WHERE id = ?";
                    if ($stmt = $db->mysqli->prepare($query)) {
                        $stmt->bind_param("ii", $stock_tambah, $produk_id);
                        if ($stmt->execute()) {
                            
                            $insertStokMasuk = "INSERT INTO stok_masuk (produk_id, jumlah, user, createdAt) VALUES (?, ?, ?, NOW())";
                            if ($stmt = $db->mysqli->prepare($insertStokMasuk)) {
                                $stmt->bind_param("iis", $produk_id, $stock_tambah, $user);
                                if ($stmt->execute()) {
                                    header("Location: vw_produk.php");
                                    exit();
                                } else {
                                    echo "Error: " . $stmt->error;
                                }
                            } else {
                                echo "Error: " . $db->mysqli->error;
                            }
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                    } else {
                        echo "Error: " . $db->mysqli->error;
                    }
                } else {
                    echo "Semua field harus diisi";
                }
                break;


            case 'edit':
                $id = $_POST['id'];
                $nama_produk = $_POST['nama_produk'];
                $harga = $_POST['harga'];
                $stock = $_POST['stock'];

                if (!empty($id) && !empty($nama_produk) && !empty($harga) && !empty($stock)) {
                    $query = "UPDATE produk SET namaProduk = ?, harga = ?, stock = ?, updatedAt = NOW() WHERE id = ?";
                    if ($stmt = $db->mysqli->prepare($query)) {
                        $stmt->bind_param("sdii", $nama_produk, $harga, $stock, $id);
                        if ($stmt->execute()) {
                                header("Location: vw_produk.php");
                                exit();
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                        } else {
                            echo "Error: " . $db->mysqli->error;
                        }
                    } else {
                        echo "All fields are required.";
                    }
                    break;
    
                case 'delete':
                    $id = $_POST['id'];
                    if (!empty($id)) {
                        $query = "DELETE FROM produk WHERE id = ?";
                        if ($stmt = $db->mysqli->prepare($query)) {
                            $stmt->bind_param("i", $id);
                            if ($stmt->execute()) {
                                header("Location: vw_produk.php");
                                exit();
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                        } else {
                            echo "Error: " . $db->mysqli->error;
                        }
                    } else {
                        echo "ID is required.";
                    }
                    break;
        }
    }
}
?>
