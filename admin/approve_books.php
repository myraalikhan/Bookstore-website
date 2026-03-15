<?php
include('../includes/config.php');

$query = "SELECT * FROM resell_books WHERE status='Pending'";
$result = mysqli_query($conn, $query);
?>

<h2>Approve Resell Books</h2>

<table border="1">
<tr>
<th>Book</th>
<th>Author</th>
<th>Price</th>
<th>Condition</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?php echo $row['book_name']; ?></td>
<td><?php echo $row['author']; ?></td>
<td><?php echo $row['price']; ?></td>
<td><?php echo $row['book_condition']; ?></td>
<td><img src="../assets/images/<?php echo $row['image']; ?>" width="80"></td>

<td>
<a href="approve.php?id=<?php echo $row['resell_id']; ?>">Approve</a> |
<a href="reject.php?id=<?php echo $row['resell_id']; ?>">Reject</a>
</td>
</tr>

<?php } ?>
</table>
