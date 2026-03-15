<?php
include '../includes/config.php';
include '../includes/header.php';

// get all catgories from categories table, stores result in $cat_result
$cat_result = mysqli_query($conn, "SELECT * FROM categories");

// checks if the user selected a category and if its a valid number?
if(isset($_GET['category']) && is_numeric($_GET['category'])) 
{ // if the user has selected a category- show books from that category only.
$category_id = intval($_GET['category']);
$result = mysqli_query($conn, "SELECT * FROM products WHERE category_id = $category_id");
} 
else { // if not selected any category- show all books
$result = mysqli_query($conn, "SELECT * FROM products");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Books | Words & Willow</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- CATEGORY BAR -->
<div class="category-bar">
<a href="products.php" class="category-link <?php if(!isset($_GET['category'])) echo 'active'; ?>">All Books</a>
<?php 
    // Reseting pointer for while loop
mysqli_data_seek($cat_result, 0);
while($cat = mysqli_fetch_assoc($cat_result)) { 
$active = (isset($_GET['category']) && $_GET['category'] == $cat['category_id']) ? 'active' : '';
    ?>
    <a href="products.php?category=<?php echo $cat['category_id']; ?>" class="category-link <?php echo $active; ?>">
    <?php echo $cat['name']; ?>
    </a>
    <?php } ?>
</div>

<!--SECTION TITLE -->
<h2 class="section-title">Browse Our Collection</h2>

<!--PRODUCTS GRID -->
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
