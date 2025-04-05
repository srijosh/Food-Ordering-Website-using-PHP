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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Birthstone&family=Lugrasimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="navbar-container">
            <div id="burger-menu-icon">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="logo">
                <a href="<?php echo SITEURL ?>index.php"><img src="images/Logo.webp" alt="Logo"><span>CraveCloud</span></a>
            </div>

            <div class="menu-left burger-disabled" id="menu-left">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Category</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Food</a></li>
                    <li><a href="<?php echo SITEURL; ?>about.php">About Us</a></li>
                </ul>
            </div>

            <div class="menu-right" id="menu-right">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>mycart.php"><i class="fa-solid fa-bag-shopping"></i> Rs.
                            <?php echo isset($_SESSION['total_price']) ? $_SESSION['total_price'] : "0"; ?>
                        </a></li>
                    <li>
                        <div class="user-icon" id="user-icon">
                            <?php if (!isset($_SESSION['user'])) : ?>
                                <i class="fa-solid fa-user"></i>
                                <div class="user-menu" id="user-menu">
                                    <ul>
                                        <li><a href="<?php echo SITEURL; ?>login.php">Login</a></li>
                                        <li><a href="<?php echo SITEURL; ?>add-user.php">Register</a></li>
                                    </ul>
                                </div>
                            <?php else : ?>
                                <i class="fa-solid fa-user"></i>
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
                    <li><a href="<?php echo SITEURL; ?>admin"><i class="fa-solid fa-user-gear"></i></a></li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var userIcon = document.getElementById("user-icon");
            var userMenu = document.querySelector(".user-menu"); // Use querySelector to select the first .user-menu
            var isOverMenu = false;

            // Toggle user menu visibility when user icon is clicked
            userIcon.addEventListener("mouseenter", function(event) {
                userMenu.style.display = 'block'; // Toggle the 'active' class on userMenu
            });

            userMenu.addEventListener("mouseover", function(event) {
                isOverMenu = true;
                userMenu.style.display = 'block'; // Toggle the 'active' class on userMenu
            });

            userIcon.addEventListener("mouseleave", function(event) {
                setTimeout(() => {
                    if (!isOverMenu) {
                        userMenu.style.display = 'none';
                    }
                }, 100)
            });

            userMenu.addEventListener("mouseleave", function(event) {
                setTimeout(() => {
                    userMenu.style.display = 'none';
                    isOverMenu = false;
                }, 100)
            });
        });


        function preventScroll(event) {
            event.preventDefault();
            window.scrollTo(0, 0);
        }

        var navbarIcons = document.getElementById('menu-left');
        document.getElementById('burger-menu-icon').addEventListener("click", (event) => {
            navbarIcons.classList.remove('burger-disabled');
            navbarIcons.classList.add('burger-active');
            let burgerMenu = document.querySelector('.burger-active');
            event.stopPropagation();
            document.addEventListener('scroll', preventScroll, {
                passive: false
            });

        });

        document.addEventListener("click", function(e) {
            if (!navbarIcons.contains(e.target) && e.target !== document.getElementById('burger-menu-icon')) {
                navbarIcons.classList.remove('burger-active');
                navbarIcons.classList.add('burger-disabled')
                document.removeEventListener('scroll', preventScroll, {
                    passive: false
                });
            }
        });
    </script>
</body>

</html>