<?php
session_start();
include('../includes/config.php');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
    } else {
        echo "<script>alert('Invalid Login');</script>";
    }
}
?>

<link rel="stylesheet" href="admin_style.css">

<div class="container">
<div class="header">
<h1>📚 Bookstore Admin Login</h1>
</div>

<div class="card" style="width:40%; margin:auto; margin-top:50px;">
<form method="POST">
<h2>Login</h2>

<label>Username</label>
<input type="text" name="username" required>

<label>Password</label>
<input type="password" name="password" required>

<br><br>
<button class="btn" name="login">Login</button>
</form>
</div>
</div>
