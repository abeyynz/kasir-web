<?php
include 'database.php';
$db = new database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == 'edit') {
        $username = $_POST['username'];
        $nama = $_POST['nama'];
        $role = $_POST['role'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];

        $sql = "UPDATE user SET nama=?, role=?, email=?, nohp=? WHERE username=?";
        $stmt = $db->mysqli->prepare($sql);
        $stmt->bind_param("sssss", $nama, $role, $email, $nohp, $username);

        if ($stmt->execute()) {
            header("Location: vw_user.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } elseif ($action == 'delete') {
        $username = $_POST['username'];

        $sql = "DELETE FROM user WHERE username=?";
        $stmt = $db->mysqli->prepare($sql);
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            header("Location: vw_user.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
} else {
    echo "Invalid request method.";
}
?>
