<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php

        //SQL Query to Get foods based on search keyword
        //$search = burger '; DROP database name;
        // so prevent sql injection
        $search = mysqli_real_escape_string($conn, $_POST['search']);

        ?>


        <h2>Foods on Your Search <span class="text-white">"<?php echo $search; ?>"</span></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <div class="foods">
            <?php


            // "SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger%'";
            //LIKE operator is used for pattern matching
            //% wildcard allows for matching any sequence of characters.
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether food available of not
            if ($count > 0) {
                //Food Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the details
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
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>