<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions {
            display: flex;
            justify-content: space-around;
        }

        .update,
        .delete {
            cursor: pointer;
            color: #007bff;
        }

        .update:hover,
        .delete:hover {
            text-decoration: underline;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
        }

        .modal-btns {
            margin-top: 20px;
        }
        .update-btn {
            cursor: pointer;
            background-color: #2348ff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
        }

        .update-btn:hover {
            background-color: #2349ff;
        }
    </style>
</head>


<body>
<div class="container" >
        <h1>All Inventory</h1>
        <a href="addinventory.php"><button class="update-btn">Add Inventory</button></a>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Cost Price</th>
                    <th>Selling Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database configuration
                include('../config.php');

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
                    // Validate and sanitize the input
                    $deleteId = filter_var($_POST['delete_id'], FILTER_SANITIZE_STRING);
                
                    // Prepare the DELETE statement using a prepared statement
                    $deleteSql = "DELETE FROM inventory WHERE productID = ?";
                    $stmt = $conn->prepare($deleteSql);
                    $stmt->bind_param("s", $deleteId); // "s" indicates string type
                
                    if ($stmt->execute()) {
                        echo "<script>alert('Record deleted successfully');</script>";
                        echo '<meta http-equiv="refresh" content="0">'; // Refresh the page after deletion
                    } else {
                        echo "Error deleting record: " . $stmt->error;
                    }
                
                    // Close the statement
                    $stmt->close();
                }
                // SQL query to fetch all inventory data from the database
                $sql = "SELECT * FROM inventory";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['productID'] . "</td>";
                        echo "<td>" . $row['productName'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td>" . $row['size'] . "</td>";
                        echo "<td>" . $row['color'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['costPrice'] . "</td>";
                        echo "<td>" . $row['sellingPrice'] . "</td>";
                        echo '<td class="actions">
                                <form method="post">
                                    <input type="hidden" name="delete_id" value="' . $row['productID'] . '">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                                <a class="update-btn" href="updateinventory.php?productID=' . $row['productID'] . '">Update</a>
                              </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
