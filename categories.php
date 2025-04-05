<?php include('partials-front/menu.php'); ?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Categories</h2>
        <div class="category">
            <?php
            // Create SQL Query to Display Categories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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


<?php include('partials-front/footer.php'); ?>