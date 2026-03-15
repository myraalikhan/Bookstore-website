<?php
include('../includes/header.php');
include('../includes/config.php');
//how my dummy checkout orks???
// $_session[cart]- means the shopping cart that is stored on the server
//isset- means "does this esits?"
//empty- meand is the cart empty?
// so basically the entire line means- if the cart does not exists or it is empty and run the "your cart is empty" line
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
echo "<p style='text-align:center; margin-top:50px;'>cart is empty.</p>";
exit(); //if the cart is empty, page stops here
}

$total = 0; //starting counting from 0
foreach($_SESSION['cart'] as $id => $quantity) //looping through cart, it means look at each item inside the cart
{
    $query = "SELECT * FROM products WHERE product_id=$id"; 
    $result = mysqli_query($conn, $query); //stores the result from above command
    $row = mysqli_fetch_assoc($result); //getting product info
    if(!$row) continue; // if product doesnt exists, go to the next one| $roe contains product name, price, image
    $subtotal = $row['price'] * $quantity;
    $total += $subtotal; //adds this items money to the final total so now $total keeps growing
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout | Words & Willow</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<h2 class="section-title">Checkout</h2>

<div class="checkout-container">
<!-- BILLING FORM -->
    <div class="billing-form">
        <h3>Billing Information</h3>
        <form method="POST" action="process_order.php"> <!-- dummy processing page -->
            <!-- when the user clicks on place order, all data is sent tp processorder.php and it collects the name, email, address etc -->
            <input type="text" name="name" placeholder="Full Name" required> <!-- input- allows user to enter data, placeholder is the grey text inside the box before typing and it disappears when the user starts typing. and reuired means this field is required before submitting-->
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="postal" placeholder="Postal Code" required>
            <input type="text" name="country" placeholder="Country" required>

            <!-- PAYMENT METHOD -->
            <h3>Payment Method (Dummy)</h3>
            <label><input type="radio" name="payment" value="card" checked> Credit / Debit Card</label><br>
            <label><input type="radio" name="payment" value="upi"> UPI</label><br>
            <label><input type="radio" name="payment" value="cod"> Cash on Delivery</label><br><br>

            <button type="submit" class="btn checkout-btn">Place Order</button>
        </form>
    </div>

    <!-- CART SUMMARY -->
    <div class="cart-summary">
        <h3>Order Summary</h3>
        <?php foreach($_SESSION['cart'] as $id => $quantity):
            $query = "SELECT * FROM products WHERE product_id=$id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            if(!$row) continue;
            $subtotal = $row['price'] * $quantity;
        ?>
            <p><?php echo $row['name']; ?> item <?php echo $quantity; ?> = ₹<?php echo $subtotal; ?></p> <!--prints each item-->
        <?php endforeach; ?>
        <hr>
        <h3>Total: ₹<?php echo $total; ?></h3>
    </div>

</div>

</body>
</html>