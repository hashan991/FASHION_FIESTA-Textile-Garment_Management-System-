<?php 
include('header.php');
?>

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
        }

        .container {
            max-width: 800px;
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
    </style>
</head>

<body>
    <div class="container">
        <h1>User Data</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database configuration
                include('config.php');

                // Check if delete button is clicked
                if (isset($_POST['delete_id'])) {
                    $deleteId = $_POST['delete_id'];
                    $deleteSql = "DELETE FROM contactus WHERE id = $deleteId";
                    if ($conn->query($deleteSql) === TRUE) {
                        echo "<script>alert('Record deleted successfully');</script>";
                    } else {
                        echo "Error deleting record: " . $conn->error;
                    }
                }

                // SQL query to fetch data from the database
                $sql = "SELECT * FROM contactus";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['message'] . "</td>";
                        echo '<td class="actions">
                                <form method="post">
                                    <input type="hidden" name="delete_id" value="' . $row['id'] . '">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                                <a href="updatecontactus.php?id=' . $row['id'] . '"><button class="update-btn"> Update </button></a>
                              </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <style>
        .delete-btn {
            cursor: pointer;
            background-color: #ff6961;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
        }

        .delete-btn:hover {
            background-color: #ff3333;
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
</body>

</html>