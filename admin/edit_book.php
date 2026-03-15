<?php
include('../includes/config.php');

$id = $_GET['id'];

$query = "SELECT * FROM products WHERE product_id=$id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

    $update = "UPDATE products 
               SET name='$name', price='$price', stock='$stock', category_id='$category'
               WHERE product_id=$id";

    mysqli_query($conn, $update);
    header("Location: manage_books.php");
}
?>

<h2>Edit Book</h2>

<form method="POST">
Book Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
Price: <input type="text" name="price" value="<?php echo $row['price']; ?>"><br><br>
Stock: <input type="number" name="stock" value="<?php echo $row['stock']; ?>"><br><br>
Category ID: <input type="number" name="category" value="<?php echo $row['category_id']; ?>"><br><br>

<button name="update">Update Book</button>
</form>
