<?php
include('../includes/config.php');

if(isset($_POST['add'])){
$name = $_POST['name'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$category = $_POST['category'];
$image = $_FILES['image']['name'];
$target = "../assets/images/".$image;
move_uploaded_file($_FILES['image']['tmp_name'], $target);

$query = "INSERT INTO products (name, price, image, stock, category_id)
VALUES ('$name', '$price', '$image', '$stock', '$category')";
mysqli_query($conn, $query);
header("Location: manage_books.php");
}
?>

<link rel="stylesheet" href="admin_style.css">

<div class="header">
<h1>Add New Book</h1>
</div>

<div class="container">
<div class="card" style="width:50%; margin:auto;">
<form method="POST" enctype="multipart/form-data">


<label>Book Name</label>
<input type="text" name="name" required>

<label>Price</label>
<input type="text" name="price" required>

<label>Stock</label>
<input type="number" name="stock" required>

<label>Book Image</label>
<input type="file" name="image" required>


<label>Category ID</label>
<input type="number" name="category" required>

<br><br>
<button class="btn" name="add">Add Book</button>

</form>
</div>
</div>
