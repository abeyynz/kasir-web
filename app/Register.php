<?php

require_once "database.php";

class Register {
    public $mysqli;

    function __construct() {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    function register() {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nohp = $_POST['nohp'];
        $role = $_POST['role'];

        if (empty($user) || empty($pass) || empty($nama) || empty($email) || empty($nohp) || empty($role)) {
            return 'Form tidak boleh kosong!';
        } else {
            $get_user = "SELECT * FROM user WHERE username = '$user'";
            $result = $this->mysqli->query($get_user);
            $check_user = $result->num_rows;

            if ($check_user == 1) {
                return 'Username sudah ada!';
            } else {
                $pass = password_hash($pass, PASSWORD_DEFAULT);

                $sql = 'INSERT INTO user (username, password, nama, role, email, nohp) VALUES (?, ?, ?, ?, ?, ?)';
                $query = $this->mysqli->prepare($sql);
                $query->bind_param('ssssss', $user, $pass, $nama, $role, $email, $nohp);

                if ($query->execute()) {
                    return 'Register Success';
                } else {
                    return 'Register failed';
                }
            }
        }
    }
}
?>
