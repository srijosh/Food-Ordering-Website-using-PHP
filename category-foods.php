    <?php include('partials-front/menu.php'); ?>

    <?php
    //CHeck whether id is passed or not
    if (isset($_GET['category_id'])) {
        //Category id is set and get the id
        $category_id = $_GET['category_id'];
        // Get the CAtegory Title Based on Category ID
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Get the value from Database
        $row = mysqli_fetch_assoc($res);
        //Get the TItle
        $category_title = $row['title'];
    } else {
        //CAtegory not passed
        //Redirect to Home page
        header('location:' . SITEURL);
    }
    ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="foods">
                <?php

                //Create SQL Query to Get foods based on Selected CAtegory
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the Rows
                $count2 = mysqli_num_rows($res2);

                //CHeck whether food is available or not
                if ($count2 > 0) {
                    while ($row = mysqli_fetch_assoc($res2)) {
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
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>