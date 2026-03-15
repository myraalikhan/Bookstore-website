<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "online_shopping";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}
?>
