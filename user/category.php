<?php
include('../includes/config.php');
include('../includes/header.php');

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $category_id = intval($_GET['id']);

    // Fetch category name
    $cat_query = mysqli_query($conn, "SELECT * FROM categories WHERE category_id = $category_id");
    $cat_data = mysqli_fetch_assoc($cat_query);
    if(!$cat_data){ echo "Category not found."; exit; }
    $category_name = $cat_data['name'];

    // Fetch products
    $sql = "SELECT * FROM products WHERE category_id = $category_id";
    $result = mysqli_query($conn, $sql);
} else {
    echo "Invalid Category."; exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $category_name; ?> | Words & Willow</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h2 class="section-title"><?php echo $category_name; ?> Books</h2>

<div class="product-grid">
<?php 
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) { 
?>
<div class="card">
    <img src="../assets/images/<?php echo $row['image']; ?>" alt="Book Image">
    <h3><?php echo $row['name']; ?></h3>
    <p class="price">₹<?php echo $row['price']; ?></p>

    <form method="POST" action="../add_to_cart.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <button type="submit" class="btn">Add to Cart</button>
    </form>
</div>
<?php 
    }
} else {
    echo "<p style='text-align:center;'>No books found in this category.</p>";
}
?>
</div>

</body>
</html>
