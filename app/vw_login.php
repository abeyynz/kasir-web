<?php
require_once "Login.php";
session_start();

$login = new Login();
$message = "";

if (isset($_SESSION['username'])) {
    header("Location: vw_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $login->check_login();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        .login-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        .login-container label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container input[type="submit"], input[type="reset"] {
            background: #6a11cb;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover, input[type="reset"]:hover {
            background: #2575fc;
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
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($message)): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="username" style="display: flex; margin-left: 10px;">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password" style="display: flex; margin-left: 10px;">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="reset" value="RESET" name="reset">
            <input type="submit" value="LOGIN" name="login">
        </form>
    </div>
</body>
</html>
