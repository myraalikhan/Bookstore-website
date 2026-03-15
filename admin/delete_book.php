<?php
include('../includes/config.php');

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM cart_items WHERE product_id=$id");
mysqli_query($conn, "DELETE FROM products WHERE product_id=$id");

header("Location: manage_books.php");
?>
