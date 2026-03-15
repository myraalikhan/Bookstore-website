<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}
?>

<link rel="stylesheet" href="admin_style.css">

<div class="header">
<h1>📚 Admin Dashboard</h1>
</div>

<div class="nav">
 <a href="approve_books.php">Approve Resell Books</a>
<a href="manage_books.php">Manage Books</a>
<a href="view_orders.php">View Orders</a>
<a href="admin_login.php">Logout</a>
</div>

<div class="container">
<div class="card">
<h2>Welcome, Admin</h2>
<p>You can manage books and view orders from here.</p>
</div>
</div>
