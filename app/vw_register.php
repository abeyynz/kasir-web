<?php
require_once "Register.php";
$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $reg = new Register();
    $message = $reg->register();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h2 {
            color: #6a11cb;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: left;
        }
        .register-container label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        .register-container input[type="text"],
        .register-container input[type="password"],
        .register-container input[type="email"],
        .register-container input[type="number"],
        .register-container select {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
        }
        .register-container .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .register-container a, .register-container input[type="reset"], .register-container input[type="submit"] {
            background: #6a11cb;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            box-sizing: border-box;
            margin: 0 5px;
        }
        .register-container a:hover, .register-container input[type="reset"]:hover, .register-container input[type="submit"]:hover {
            background: #2575fc;
        }
        .register-container a {
            font-size: 12px;
            flex: 1;
        }
        .register-container input[type="reset"] {
            font-size: 12px;
            flex: 1;
        }
        .register-container input[type="submit"] {
            font-size: 14px;
            flex: 2;
        }
        .alert {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            color: #fff;
            background-color: #ff6b6b;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <center><h2>Register</h2></center>
        <?php if (!empty($message)): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="role">Role:</label>
            <select id="role" name="role" style="width: 100%;" required>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="kasir">Kasir</option>
                <option value="inventori">Inventori</option>
            </select>
            
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            
            <label for="nohp">No Hp:</label>
            <input type="text" id="nohp" name="nohp">
            
            <div class="form-actions">
                <a href="vw_user.php">Kembali</a>
                <input type="reset" value="Reset" name="reset">
                <input type="submit" value="REGISTER" name="register">
            </div>
        </form>
    </div>
</body>
</html>
