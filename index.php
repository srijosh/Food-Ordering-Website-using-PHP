<?php include('partials-front/menu.php'); ?>

<!-- fOod search Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <div id="search-field">
                <input type="search" id="search-input" name="search" placeholder="Search for Food..." required>
                <button type="submit" id="search-btn" name="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
</section>
<!-- food search Section Ends Here -->

<?php
if (isset($_SESSION['logout'])) {
    echo '<script>alert("' . $_SESSION['logout'] . '");</script>';
    unset($_SESSION['logout']);
}
if (isset($_SESSION['login-message'])) {
    echo '<script>alert("' . $_SESSION['login-message'] . '");</script>';
    unset($_SESSION['login-message']);
}
if (isset($_SESSION['order'])) {
    echo '<script>alert("' . $_SESSION['order'] . '");</script>';
    unset($_SESSION['order']);
}
?>

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Categories</h2>
        <div class="category">
            <?php
            // Create SQL Query to Display Categories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            // Execute the Query
            $res = mysqli_query($conn, $sql);
            // Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                // Categories Available
                while ($row = mysqli_fetch_assoc($res)) {
                    // Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
            ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>" class="box-3">
                        <div class="img-container">
                            <?php
                            // Check whether Image is available or not
                            if ($image_name == "") {
                                // Display Message
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                // Image Available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>">
                            <?php
                            }
                            ?>
                        </div>
                        <h3 class="category-title"><?php echo $title; ?></h3>
                    </a>
            <?php
                }
            } else {
                // Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
            ?>

        </div>
    </div>
</section>

<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <div class="foods">
            <?php
            // Getting Foods from Database that are active and featured
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $new_price = $row['new_price'];
                    $discount = $row['discount'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>

                    <div class="food-menu-box">
                        <a style="color: black;" href="food_info.php?food_id=<?php echo $id; ?>">
                            <div class="food-menu-img">
                                <?php
                                if ($image_name == "") {
                                    echo "<div class='error'>Image not available.</div>";
                                } else {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                                }
                                ?>
                            </div>


                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">
                                    <?php if ($price != $new_price) { ?>
                                        <span class="original-price">Rs. <?php echo $price; ?></span> <span class="discount">-<?php echo $discount ?>% </span>
                                        <br><span class="discounted-price">Rs. <?php echo $new_price; ?></span>
                                    <?php } else { ?>
                                        <span class="discounted-price">Rs. <?php echo $new_price; ?></span>
                                    <?php } ?>
                                </p>
                                <p class="food-detail"><?php echo $description; ?></p>
                                <br>
                                <form action="add_to_cart.php" method="POST">
                                    <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                                    <input type="submit" name="add_to_cart" value="Add to Cart" class="btn btn-primary">
                                </form>
                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<div class='error'>Food not available.</div>";
            }
            ?>
        </div>
    </div>
    <p class="text-center">
        <a style="color: black;" href="<?php echo SITEURL; ?>foods.php">More Foods</a>
    </p>
</section>

<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>