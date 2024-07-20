<?php
require_once "database.php";

class Login {
    public $mysqli;

    function __construct() {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    function check_login() {
        if (isset($_POST['login'])) {
            $user = $_POST['username'];
            $pass = $_POST['password'];

            if (empty($user) || empty($pass)) {
                return 'Form tidak boleh kosong!';
            }

            $sql = "SELECT * FROM user WHERE username = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param('s', $user);
            $stmt->execute();
            $result = $stmt->get_result();
            $check_user = $result->num_rows;

            if ($check_user == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($pass, $row['password'])) {
                    $_SESSION['username'] = $user;

                    if (isset($_POST['remember'])) {
                        setcookie('username', $row['username'], time() + (86400 * 30), "/"); // 30 days
                        setcookie('password', $row['password'], time() + (86400 * 30), "/"); // 30 days
                    } else {
                        if (isset($_COOKIE['username'])) {
                            setcookie('username', '', time() - 3600, "/"); // delete cookie
                        }
                        if (isset($_COOKIE['password'])) {
                            setcookie('password', '', time() - 3600, "/"); // delete cookie
                        }
                    }

                    header("Location: vw_dashboard.php");
                    exit();
                } else {
                    return 'Username atau password salah!';
                }
            } else {
                return 'Username tidak ditemukan!';
            }
        }
    }
}
?>
