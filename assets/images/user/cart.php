<?php
include("../includes/header.php");      
include("../includes/config.php");
?>

<h2 class="section-title">My Cart 🛒</h2>

                          <div class="cart-container"> <!--opens a div that will hold cart items -->

<?php
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) //if the cart does not exists or if it emptuy?
{ 
echo "<p class='empty-cart'>Your cart is empty.</p>"; //if empty print this
exit(); // if empty stop the page
}

$total = 0; //starts countin from 0
// looping thru cart
foreach($_SESSION['cart'] as $id => $quantity) 
 {

                       $query = "SELECT * FROM products WHERE product_id=$id"; //give products where id is whatever
          $result = mysqli_query($conn, $query); //runs the query
$row = mysqli_fetch_assoc($result); //converts the result into an associative array like $row['name'], $row['price'], $row['image']. getting product info

if(!$row) continue; // if product does not exits, move furher

$subtotal = $row['price'] * $quantity;
 $total += $subtotal;
?>
<div class="cart-item"> <!--creates a cart item block-->
<img src="../assets/images/<?php echo $row['image']; ?>"> <!--prints product iamge-->

 <div class="cart-details"> <!--shows name, price, uantity, subtotal-->
    <h3><?php echo $row['name']; ?></h3>
            <p>Price: ₹<?php echo $row['price']; ?></p>
            <p>Quantity: <?php echo $quantity; ?></p>
            <p>Subtotal: ₹<?php echo $subtotal; ?></p>
<!-- When user clicks Remove, it sends a POST request to remove_from_cart.php.
It sends product_id (hidden) so that file knows which item to remove from the session cart-->
<form method="POST" action="remove_from_cart.php">
 <input type="hidden" name="product_id" value="<?php echo $id; ?>">
<button type="submit" class="btn btn-danger">Remove</button>
</form> 
</div>
</div>

<?php } ?>

</div>

<div class="cart-summary">
    <h3>Total: ₹<?php echo $total; ?></h3> <!--prints the total-->
    <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a> <!--link to checkout page-->

</div>

<!-- RECOMMENDATION SECTION    if a user has books in their cart…
find other books from the SAME category
and show up to 4 of them-->
<h2 class="section-title">You May Also Like </h2>

<div class="product-grid"> <!--creates a container for recommended books-->

<?php
//tracking variables
$shown = []; // this is an empty array which stores the ids of the ptoducts that i ahvae already displayed| it also prevents duplicates
$count = 0; // starts count at 0- how many reccommendations shown so far
// looping through aall items in the users cart.
foreach($_SESSION['cart'] as $id => $quantity) {
 $query = "SELECT category_id FROM products WHERE product_id=$id"; //gets the catergory id pf the product already in cart.
   
 $result = mysqli_query($conn, $query); //runs the sql query | $conn is my db connection
    
 $row = mysqli_fetch_assoc($result); // fetches the result as an associative array( a ds that stores elements as a collection of key value pairs)
//now $row['categoryid] contains category
   
if(!$row) continue;

 $category = $row['category_id']; //saves category id in category

 // recommendation logic- give me products where the category is same, product is not as same as in the cart, only give up to 4 recommendations
    // finding other products of the same category
   $rec_query = "SELECT * FROM products 
                  WHERE category_id=$category 
                  AND product_id != $id 
                  LIMIT 4";

 $rec_result = mysqli_query($conn, $rec_query);// runs recommendation uery, stoes result
// looping through recommended results
while($rec = mysqli_fetch_assoc($rec_result)) {
// avoiding duplicates and also limit to 4
    if(!in_array($rec['product_id'], $shown) && $count < 4) // means that if this product id is not already shown AND i have shown less than 4 products, then show it
            {

            echo "<div class='card'>"; //creates product card container
            echo "<img src='../assets/images/".$rec['image']."'>";//displays product image
            echo "<h3>".$rec['name']."</h3>"; //displays product name
            echo "<p>₹".$rec['price']."</p>"; // displays product price
            echo "</div>"; //closes product card div

            $shown[] = $rec['product_id']; // id ko shown mein daal deta hai
            $count++; // recommendeation counter increased by 1
        }
    }
}                   //SIMPLY THIS IS A CATEGORY BASED RECOMMENDATION SYSTEM WHERE IF YOU BASICALLY LIKE A PRODUCT THEN WE WILL RECOMMENT YOU PRODUCTS FROM THE SAME CATEGORY.
?>           

</div>
