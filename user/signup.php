<?php
include '../includes/header.php';

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $emailid = $_POST['emailid'];
    $telephone_no = $_POST['telephone_no'];
    $password = $_POST['password'];

    // Encrypt password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, emailid, telephone_no, password)
            VALUES ('$name', '$emailid', '$telephone_no', '$hashed_password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Signup Successful! Please Login');</script>";
        echo "<script>window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<form method="POST">
    Name: <input type="text" name="name" required><br><br>

    Email: <input type="email" name="emailid" required><br><br>

    Phone: <input type="text" name="telephone_no" required><br><br>

    Password: <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>
