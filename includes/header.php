<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Ink & Archive</h1>

    <nav>
        <a href="/online-shopping-devops/index.php">Home</a>
        <a href="/online-shopping-devops/user/products.php">Books</a>
        <a href="/online-shopping-devops/user/cart.php">Cart</a>

        <?php if(isset($_SESSION['user_id'])) { ?>
            <a href="/online-shopping-devops/user/logout.php">Logout</a>
        <?php } else { ?>
            <a href="/online-shopping-devops/user/login.php">Login</a>
        <?php } ?>
    </nav>
</header>
