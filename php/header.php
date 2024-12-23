<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../styles/header.css"/>
</head>

<body>
    <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-title">
                JoGeek
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

        <div class="nav-links">
            <a href="../contactus.php">Contact Us</a>
            <a href="allinventory.php" >Inventory</a>
            <a href="../fetchContactUs.php" >Fetched Contacts</a>
            <a href="SignUpSignIn.php" id="signInButton"><button class="update-btn">SignIn</button></a>
        </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var signInButton = document.getElementById("signInButton");
            var emailCookie = getCookie("email");

            if (emailCookie) {
                signInButton.innerHTML = '<button class="update-btn">Profile</button>';
                signInButton.href = "php/profile.php";
            }

            function getCookie(name) {
                var value = "; " + document.cookie;
                var parts = value.split("; " + name + "=");
                if (parts.length == 2) return parts.pop().split(";").shift();
            }
        });
    </script>
</body>

</html>