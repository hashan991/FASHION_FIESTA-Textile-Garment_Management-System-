<?php 
include('header.php');
?>

<!DOCTYPE html>
<html>

<head>
    
<link rel="stylesheet" href="./styles/header.css" />
    <link rel="stylesheet" href="./styles/style.css" />
</head>

<body style="
    background-color: #f2f2f2;">

<div class="product-list">
        <div class="product">
            <img src="images/bg.jpg" width="300px" alt="Shirt">
            <h2>Men's Shirt</h2>
            <p>High-quality cotton shirt for men.</p>
            <p><strong>Price: $29.99</strong></p>
            <button class="add-to-cart btn-primary" data-product="Men's Shirt">Add to Cart</button>
        </div>

        <div class="product">
            <img src="images/bg.jpg" width="300px" alt="Dress">
            <h2>Women's Dress</h2>
            <p>Elegant dress for women, perfect for any occasion.</p>
            <p><strong>Price: $39.99</strong></p>
            <button class="add-to-cart btn-primary" data-product="Women's Dress">Add to Cart</button>
        </div>
    </div>

    <div class="cart">
        <h2>Shopping Cart</h2>
        <ul id="cart-items">
        </ul>
        <p>Total: <span id="cart-total">$0.00</span></p>
        <button id="checkout-btn">Proceed to Checkout</button>
    </div>
    <script src="scripts/script.js"></script>
</body>

</html>