<?php
include('../includes/config.php');

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM resell_books WHERE resell_id=$id");
$row = mysqli_fetch_assoc($result);

mysqli_query($conn,
"INSERT INTO products (name, price, stock, image, category_id)
VALUES ('{$row['book_name']}', '{$row['price']}', 1, '{$row['image']}', 4)");

mysqli_query($conn, "UPDATE resell_books SET status='Approved' WHERE resell_id=$id");

header("Location: approve_books.php");
?>
