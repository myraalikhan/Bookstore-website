<?php
include '../includes/header.php';

if (isset($_POST['login'])) {

    $emailid = $_POST['emailid'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE emailid='$emailid'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['name'];

            echo "<script>alert('Login Successful');</script>";
            echo "<script>window.location='dashboard.php';</script>";

        } else {
            echo "<script>alert('Wrong Password');</script>";
        }

    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
<form method="POST">
    Email: <input type="email" name="emailid" required><br><br>

    Password: <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>
