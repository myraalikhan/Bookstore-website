<<?php
include('../includes/config.php');

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
?>

<link rel="stylesheet" href="admin_style.css">

<div class="header">
<h1>🛒 Customer Orders</h1>
</div>

<div class="nav">
<a href="admin_dashboard.php">Dashboard</a>
<a href="manage_books.php">Manage Books</a>
</div>

<div class="container">
<div class="card">

<table>
<tr>
<th>Order ID</th>
<th>User ID</th>
<th>Total Amount</th>
<th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $row['order_id']; ?></td>
<td><?php echo $row['user_id']; ?></td>
<td>₹<?php echo $row['total_amount']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>
</table>

</div>
</div>
