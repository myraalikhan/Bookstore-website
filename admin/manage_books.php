<?php
include('../includes/config.php');
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<link rel="stylesheet" href="admin_style.css">

<div class="header">
<h1>📖 Manage Books</h1>
</div>

<div class="nav">
<a href="admin_dashboard.php">Dashboard</a>
<a href="add_book.php">Add New Book</a>
<a href="view_orders.php">View Orders</a>
</div>

<div class="container">
<div class="card">

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $row['product_id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td>₹<?php echo $row['price']; ?></td>
<td><?php echo $row['stock']; ?></td>
<td>
<a class="btn" href="edit_book.php?id=<?php echo $row['product_id']; ?>">Edit</a>
<a class="btn" href="delete_book.php?id=<?php echo $row['product_id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>

</div>
</div>
