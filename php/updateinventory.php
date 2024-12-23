<?php
include('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    // Validate and sanitize input data
    $productID = filter_var($_POST['update_id'], FILTER_SANITIZE_STRING);
    $productName = filter_var($_POST['productName'], FILTER_SANITIZE_STRING);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
    $size = filter_var($_POST['size'], FILTER_SANITIZE_STRING);
    $color = filter_var($_POST['color'], FILTER_SANITIZE_STRING);
    $quantity = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);
    $costPrice = filter_var($_POST['costPrice'], FILTER_VALIDATE_INT);
    $sellingPrice = filter_var($_POST['sellingPrice'], FILTER_VALIDATE_INT);

    // Prepare and execute the update query using a prepared statement
    $updateSql = "UPDATE inventory SET productName=?, category=?, size=?, color=?, quantity=?, costPrice=?, sellingPrice=? WHERE productID=?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssiiis", $productName, $category, $size, $color, $quantity, $costPrice, $sellingPrice, $productID);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: allinventory.php"); // Redirect to allinventory.php after successful update
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

// Fetch the existing data for the specified productID
if (isset($_GET['productID'])) {
    $productID = filter_var($_GET['productID'], FILTER_SANITIZE_STRING);

    // Fetch data using a prepared statement
    $selectSql = "SELECT * FROM inventory WHERE productID=?";
    $stmt = $conn->prepare($selectSql);
    $stmt->bind_param("s", $productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo "Record not found!";
        $stmt->close();
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
    <style>
        .outer {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            padding-left: 30px;
            padding-right: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="outer">
        <div class="container">
            <h2>Update Inventory</h2>
            <form method="post">
                <input type="hidden" name="update_id" value="<?php echo $row['productID']; ?>">
                Product Name: <input type="text" name="productName" value="<?php echo $row['productName']; ?>" required><br><br>
                Category: <input type="text" name="category" value="<?php echo $row['category']; ?>" required><br><br>
                Size: <input type="text" name="size" value="<?php echo $row['size']; ?>" required><br><br>
                Color: <input type="text" name="color" value="<?php echo $row['color']; ?>" required><br><br>
                Quantity: <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required><br><br>
                Cost Price: <input type="number" name="costPrice" value="<?php echo $row['costPrice']; ?>" required><br><br>
                Selling Price: <input type="number" name="sellingPrice" value="<?php echo $row['sellingPrice']; ?>" required><br><br>
                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>

</html>