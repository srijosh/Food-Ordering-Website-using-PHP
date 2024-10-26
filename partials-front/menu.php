<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var userIcon = document.getElementById("user-icon");
            var userMenu = document.querySelector(".user-menu"); // Use querySelector to select the first .user-menu

            // Toggle user menu visibility when user icon is clicked
            userIcon.addEventListener("click", function(event) {
                event.stopPropagation(); // Prevents immediate closing of the menu
                userMenu.classList.toggle("active"); // Toggle the 'active' class on userMenu
            });

            // Close the menu when clicking outside of it
            document.addEventListener("click", function(event) {
                if (event.target !== userIcon) {
                    userMenu.classList.remove("active"); // Remove 'active' class if clicking outside
                }
            });
        });
    </script>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="navbar-container">
            <div class="logo">
                <img src="images/Logo.webp" alt="Logo">
            </div>

            <div class="menu-left" id="menu-left">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Category</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Food</a></li>
                    <li><a href="<?php echo SITEURL; ?>about.php">About Us</a></li>
                </ul>
            </div>

            <div class="menu-right" id="menu-right">
                <ul>
                    <li>
                        <div class="user-icon" id="user-icon">
                            <?php if (!isset($_SESSION['user'])) : ?>
                                <img src="images/user.png" alt="User" width="40" height="20">
                                <div class="user-menu" id="user-menu">
                                    <ul>
                                        <li><a href="<?php echo SITEURL; ?>login.php">Login</a></li>
                                        <li><a href="<?php echo SITEURL; ?>add-user.php">Register</a></li>
                                    </ul>
                                </div>
                            <?php else : ?>
                                <img src="images/user.png" alt="User" width="40" height="20">
                                <div class="user-menu" id="user-menu">
                                    <ul>
                                        <li><a href="<?php echo SITEURL; ?>account.php">Account</a></li>
                                        <li><a href="<?php echo SITEURL; ?>order.php">Order History</a></li>
                                        <li><a href="<?php echo SITEURL; ?>logout.php">Logout</a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li><a href="<?php echo SITEURL; ?>mycart.php"><img src="images/cart.png" alt="Cart" width="27" height="18"> Rs.
                            <?php echo isset($_SESSION['total_price']) ? $_SESSION['total_price'] : "0"; ?>
                        </a></li>
                    <li><a href="<?php echo SITEURL; ?>admin"><img src="images/admin.png" alt="Admin" width="30" height="20"> </a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->