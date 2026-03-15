<?php
session_start();

// Clear the cart (dummy order)
unset($_SESSION['cart']);

// Show success message
echo "<p style='text-align:center; margin-top:100px; font-size:18px;'>
Thank you! Your order has been placed. 🛒<br>
<a href='products.php'>Continue Shopping</a>
</p>";
