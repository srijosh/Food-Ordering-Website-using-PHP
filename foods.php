<?php
include('partials-front/menu.php');
?>

<section class="food-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <div class="foods">
            <?php
            // Getting Foods from Database that are active and featured
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes'";
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
                        <a href="food_info.php?food_id=<?php echo $id; ?>">
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
        <a href="<?php echo SITEURL; ?>foods.php">More Foods</a>
    </p>
</section>

<?php include('partials-front/footer.php'); ?>