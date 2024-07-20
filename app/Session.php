<?php

require_once "database.php";
$db = new database();

class Session{
    public $mysqli;
    public $login_user;
    public $user_role; 
    public $nama;
    public $iduser;

    function __construct(){
        session_start();
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->check_session();
        $this->handle_logout();
    }

    function check_session(){
        $user_check = $_SESSION['username'];
        $ses_sql = "SELECT * FROM user WHERE username='$user_check'";
        $query = $this->mysqli->query($ses_sql);
        $row = $query->fetch_row();
        $this->login_user = $row[1];
        $this->user_role = $row[4];
        $this->nama = $row[2];
        $this->iduser = $row[0];
        if (!isset($user_check)){
            header("location: vw_login.php");
        }
    }

    function handle_logout(){
        if (isset($_GET['logout'])) {
            session_destroy();
            header("Location: vw_login.php");
            exit();
        }
    }
}

?>