<?php
DEFINE("DB_HOST", "localhost");
DEFINE("DB_USER", "root");
DEFINE("DB_PASS", "");
DEFINE("DB_NAME", "appkasir");

class database{
    public $mysqli;
    function __construct()
    {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->mysqli->connect_errno){
            echo "Gagal Connect ke MySQL: " . $this->mysqli->connect_error;
        }
    }
    function __destruct()
    {
        $this->mysqli->close();
    }
}

?>