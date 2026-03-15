<?php
include('../includes/config.php');

$id = $_GET['id'];

mysqli_query($conn, "UPDATE resell_books SET status='Rejected' WHERE resell_id=$id");

header("Location: approve_books.php");
?>
