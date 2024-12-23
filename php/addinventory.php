<?php
include('header.php');
include('../config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Inventory</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url("images/bg.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #333333;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        .form-group select {
            width: calc(100% - 22px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        .form-group input[type="submit"] {
            background-color: #2348ff;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-group input[type="submit"]:hover {
            background-color: #2348ee;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Add Inventory Details</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="productID">Product ID:</label>
                <input type="text" id="productID" name="productID" required>
            </div>
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
            </div>
            <div class="form-group">
                <label for="size">Size:</label>
                <input type="text" id="size" name="size" required>
            </div>
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" id="color" name="color" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity Available:</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="costPrice">Cost Price:</label>
                <input type="number" id="costPrice" name="costPrice" required>
            </div>
            <div class="form-group">
                <label for="sellingPrice">Selling Price:</label>
                <input type="number" id="sellingPrice" name="sellingPrice" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Inventory">
            </div>
        </form>
    </div>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];
    $costPrice = $_POST['costPrice'];
    $sellingPrice = $_POST['sellingPrice'];

    $sql = "INSERT INTO inventory (productID, productName, category, size, color, quantity, costPrice, sellingPrice) VALUES ('$productID', '$productName', '$category', '$size', '$color', '$quantity', '$costPrice', '$sellingPrice')";

    // Check if the query was successful
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Inventory details added successfully!');window.location='allinventory.php'</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
