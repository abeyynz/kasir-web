<?php
include 'database.php';
$db = new database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $kategori = $_POST['kategori'];
                $prefix = $_POST['prefix'];
                if (!empty($kategori) && !empty($prefix)) {
                    $query = "INSERT INTO kategori (kategori, prefix) VALUES (?, ?)";
                    if ($stmt = $db->mysqli->prepare($query)) {
                        $stmt->bind_param("ss", $kategori, $prefix);
                        if ($stmt->execute()) {
                            header("Location: vw_kategori.php");
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

            case 'edit':
                $id = $_POST['id'];
                $kategori = $_POST['kategori'];
                $prefix = $_POST['prefix'];
                if (!empty($id) && !empty($kategori) && !empty($prefix)) {
                    $query = "UPDATE kategori SET kategori = ?, prefix = ? WHERE id = ?";
                    if ($stmt = $db->mysqli->prepare($query)) {
                        $stmt->bind_param("ssi", $kategori, $prefix, $id);
                        if ($stmt->execute()) {
                            header("Location: vw_kategori.php");
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
                    $query = "DELETE FROM kategori WHERE id = ?";
                    if ($stmt = $db->mysqli->prepare($query)) {
                        $stmt->bind_param("i", $id);
                        if ($stmt->execute()) {
                            header("Location: vw_kategori.php");
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

